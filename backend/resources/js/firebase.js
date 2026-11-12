import { initializeApp } from "firebase/app";
import { getAnalytics, isSupported } from "firebase/analytics";
import { getStorage, listAll, ref, uploadBytes, uploadString } from "firebase/storage";

// Legacy Laravel/Inertia interface: supply Firebase project settings via Vite variables.
const firebaseConfig = {
  apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
  authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
  projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
  storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
  messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
  appId: import.meta.env.VITE_FIREBASE_APP_ID,
  measurementId: import.meta.env.VITE_FIREBASE_MEASUREMENT_ID,
};

export const app = initializeApp(firebaseConfig);
export const analyticsPromise = isSupported().then((supported) => supported ? getAnalytics(app) : null);
export const storage = getStorage(app);
export const rf = ref;
export const upStr = uploadString;
export const upBts = uploadBytes;
export const list = listAll;
