document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('[data-countdown]').forEach(el => {
    let end = Date.parse(el.dataset.countdown);
    const tick = () => {
      const s = Math.max(0, Math.floor((end - Date.now()) / 1000));
      const h = Math.floor(s / 3600), m = Math.floor((s % 3600) / 60), sec = s % 60;
      el.textContent = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(sec).padStart(2,'0')}`;
      if (s > 0) setTimeout(tick, 1000);
    };
    tick();
  });
});
