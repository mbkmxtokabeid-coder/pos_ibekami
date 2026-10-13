<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_dashboard_data_barang_dibeli_requires_auth(): void
    {
        $response = $this->getJson('/dashboard/data-barang-dibeli');
        $response->assertStatus(401);
    }

    public function test_dashboard_data_barang_dibeli_authenticated(): void
    {
        $user = User::where('role', 'Pemilik')->where('status', 'Aktif')->first();
        if (!$user) {
            $user = User::first();
        }

        $response = $this->actingAs($user)->getJson('/dashboard/data-barang-dibeli?filter=month');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'period_label',
                     'summary' => [
                         'total_qty',
                         'total_nominal',
                         'total_invoices',
                         'top_jenis',
                         'top_kategori'
                     ],
                     'jenis_barang' => [
                         'labels',
                         'qty',
                         'nominal'
                     ],
                     'kategori_barang' => [
                         'labels',
                         'qty',
                         'nominal',
                         'list'
                     ]
                 ]);
    }

    public function test_dashboard_data_barang_dibeli_custom_filter(): void
    {
        $user = User::where('role', 'Pemilik')->where('status', 'Aktif')->first();
        if (!$user) {
            $user = User::first();
        }

        $response = $this->actingAs($user)->getJson('/dashboard/data-barang-dibeli?filter=custom&custom_type=month_year&bulan=9&tahun=2026');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success'
                 ]);
    }

    public function test_dashboard_data_payment_activity_requires_auth(): void
    {
        $response = $this->getJson('/dashboard/data-payment-activity');
        $response->assertStatus(401);
    }

    public function test_dashboard_data_payment_activity_authenticated(): void
    {
        $user = User::where('role', 'Pemilik')->where('status', 'Aktif')->first();
        if (!$user) {
            $user = User::first();
        }

        $response = $this->actingAs($user)->getJson('/dashboard/data-payment-activity?filter=month');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'period_label',
                     'view_type',
                     'chart_data' => [
                         'type',
                         'categories',
                         'series'
                     ],
                     'income_html',
                     'structure' => [
                         'terbayar',
                         'belum_terbayar',
                         'batal',
                         'series'
                     ]
                 ]);
    }

    public function test_dashboard_data_payment_activity_custom_filter(): void
    {
        $user = User::where('role', 'Pemilik')->where('status', 'Aktif')->first();
        if (!$user) {
            $user = User::first();
        }

        $response = $this->actingAs($user)->getJson('/dashboard/data-payment-activity?filter=custom&custom_type=year&tahun=2025');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'view_type' => 'year'
                 ]);
    }
}
