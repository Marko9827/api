eronelit = new eronelit();
eronelit.run();

if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register('/sw.js');
}