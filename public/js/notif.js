// Initialize Firebase Cloud Messaging asynchronously without blocking page transitions
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-app.js";
import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.13.2/firebase-messaging.js";

const firebaseConfig = {
  apiKey: "AIzaSyCSizDxcdeW6kDoqzZjcIXh3kgyHUwAnGM",
  authDomain: "notifdev-b86ea.firebaseapp.com",
  projectId: "notifdev-b86ea",
  storageBucket: "notifdev-b86ea.appspot.com",
  messagingSenderId: "96136881763",
  appId: "1:96136881763:web:136652eaa55c4d2288ba56"
};

function initFirebaseNotif() {
  if (!('Notification' in window)) return;

  try {
    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);

    getToken(messaging, { vapidKey: 'BMqMkl2XsxFEdpIwRmXicwKuAO8GKg2vXuo3NQ58M5w9dI-d1uC8dIadam3hGBHLEpCgCzx8CX9XuRXiYTucP_E' })
      .then((currentToken) => {
        if (currentToken) {
          storeToken(currentToken);
        } else if (Notification.permission !== 'denied') {
          reqPermission();
        }
      })
      .catch((err) => {
        console.warn('FCM token retrieval skipped or failed:', err);
      });
  } catch (e) {
    console.warn('Firebase init error:', e);
  }
}

function reqPermission() {
  if (Notification.permission === 'default') {
    Notification.requestPermission().catch(() => {});
  }
}

function storeToken(token) {
  // Prevent duplicate token sync on every single page change within the session
  if (sessionStorage.getItem('fcm_token_synced') === token) {
    return;
  }

  const csrfMeta = document.querySelector('meta[name="csrf-token"]');
  const csrf = csrfMeta ? csrfMeta.getAttribute('content') : '';

  if (window.$ && csrf) {
    $.ajax({
      url: window.location.origin + '/token-notif',
      type: 'POST',
      data: { token: token },
      headers: { 'X-CSRF-TOKEN': csrf },
      success: function () {
        sessionStorage.setItem('fcm_token_synced', token);
      },
      error: function (xhr) {
        console.warn('Token sync status:', xhr.status);
      }
    });
  }
}

// Run after page finishes loading or during browser idle
if (document.readyState === 'complete') {
  setTimeout(initFirebaseNotif, 1500);
} else {
  window.addEventListener('load', () => setTimeout(initFirebaseNotif, 1500));
}