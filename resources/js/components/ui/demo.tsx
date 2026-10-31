"use client"

import { GlassIconReveal } from "./liquid-glass-logo-reveal"

export function GlassRevealIbekamiDemo() {
  return (
    <GlassIconReveal
      logo="/images/Ibekami.png"
      label="Ibekami"
      look="dark"
      background="#070709"
      plateColor="#0D0E12"
      logoColor="#F59E0B"
      originalColors={true}
      loop={false}
      className="h-svh min-h-[420px] w-full"
    />
  )
}

export default GlassRevealIbekamiDemo

