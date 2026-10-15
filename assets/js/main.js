const header = document.getElementById('siteHeader');
const heroBrandWrap = document.getElementById('heroBrandWrap');
const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const root = document.documentElement;

// --hb drives every mobile header layer. On mobile it's a timed ease-out
// tween (~900ms, same budget as the scroll carry so they land together),
// then eases back when the page heads home. Retriggering mid-flight
// restarts from the current value — no jump. Desktop never touches it;
// CSS keeps --hb:var(--p) as a no-JS fallback.
const HB_MS = 900;
let hbValue = 0, hbTarget = 0, hbRaf = null, hbFrom = 0, hbStart = 0, hbDur = HB_MS;

// mobile scroll assist — a scroll that starts near the top is carried
// down to SNAP_Y where the emblem is fully formed; scrolling back up
// inside the zone glides home to the hero. The user can grab the page
// mid-flight and it stops immediately. A 400ms cooldown after every
// carry prevents momentum tails and elastic jitter re-triggering it.
const SNAP_Y = 160;
const SNAP_MS = 900; // ease duration — matches the header's ~1s grow
// scrolling UP below this starts the header retracting — roughly where
// the hero logo's wordmark starts being legible again
const HB_HIDE_Y = 140;
let snapActive = false, prevY = window.scrollY || 0;
let snapRaf = null, snapFrom = 0, snapStart = 0, snapTarget = SNAP_Y, snapDur = SNAP_MS;
let snapCoolUntil = 0;
// direction with hysteresis — the browser chrome showing/hiding shifts
// scrollY a few px mid-gesture; only 20px of net travel counts as intent
let dir = 0, dirAnchor = window.scrollY || 0;
// an active touch means the user OWNS the scroll position — the carry
// must never fight a finger mid-drag; and fast gestures (flicks through
// the zone) are speed-runs, not candidates for the gentle settle
let touching = false, prevT = performance.now();
window.addEventListener('touchstart', () => touching = true, {passive:true});
['touchend','touchcancel'].forEach(ev =>
  window.addEventListener(ev, () => {
    touching = false;
    // iOS frequently drops the last scroll event as momentum/bounce
    // settles — re-sync on release so --hb can't park mid-flight
    setTimeout(updateScrollState, 120);
  }, {passive:true}));
const endSnap = () => {
  if(snapActive) snapCoolUntil = performance.now() + 400;
  snapActive = false;
  root.style.scrollBehavior = ''; // restore CSS smooth for anchor links
  if(snapRaf !== null){ cancelAnimationFrame(snapRaf); snapRaf = null; }
};
['wheel','touchstart'].forEach(ev =>
  window.addEventListener(ev, endSnap, {passive:true}));
// glides the page to SNAP_Y with an ease-out — scroll-behavior:smooth is
// suspended during the tween or the browser re-smooths every frame and
// the page feels like it waits for the header
function launchSnap(target, y){
  snapActive = true;
  snapTarget = target;
  snapFrom = y; snapStart = performance.now();
  snapDur = Math.max(250, SNAP_MS * Math.abs(target - y) / SNAP_Y); // pace scales with distance
  root.style.scrollBehavior = 'auto'; // instant per-frame jumps
  snapRaf = requestAnimationFrame(snapTick);
}
function snapTick(now){
  const t = Math.min(1, (now - snapStart) / snapDur);
  const e = 1 - Math.pow(1 - t, 3); // easeOutCubic
  window.scrollTo(0, Math.round(snapFrom + (snapTarget - snapFrom) * e));
  if(t < 1 && snapActive){
    snapRaf = requestAnimationFrame(snapTick);
  }else{
    // natural completion only — the page and the emblem land TOGETHER:
    // forcing hb here guarantees the resting state can never be a
    // half-dropped header, whatever interrupted its own tween
    if(t >= 1 && window.innerWidth <= 760){
      hbTarget = hbValue = (snapTarget === SNAP_Y ? 1 : 0);
      if(hbRaf !== null){ cancelAnimationFrame(hbRaf); hbRaf = null; }
      root.style.setProperty('--hb', hbValue.toFixed(4));
      root.classList.toggle('tz-landed', hbValue >= .999);
    }
    endSnap();
  }
}

function hbTick(now){
  if(window.innerWidth > 760){ hbRaf = null; return; }
  const t = Math.min(1, (now - hbStart) / hbDur);
  const e = 1 - Math.pow(1 - t, 3); // easeOutCubic — arrives ON time
  hbValue = hbFrom + (hbTarget - hbFrom) * e;
  if(t >= 1){ hbValue = hbTarget; hbRaf = null; }
  root.style.setProperty('--hb', hbValue.toFixed(4));
  root.classList.toggle('tz-landed', hbValue >= .999);
  if(hbRaf !== null) hbRaf = requestAnimationFrame(hbTick);
}

function clamp(v,min,max){ return Math.min(Math.max(v,min),max); }
// about/local sections — the hanging roots grow as each scrolls through
const tzLocalSecs = document.querySelectorAll('.tz-local');
function updateScrollState(){
  const y = window.scrollY || window.pageYOffset || 0;

  // 0–235px: the header tree sprouts and grows in step with the hero
  // logo fading out; the brand name slides in at the far left.
  const p = reduceMotion ? (y > 90 ? 1 : 0) : clamp(y / 235, 0, 1);
  // The green field stays completely hidden initially, then rises in gently.
  const grass = reduceMotion ? (y > 90 ? 1 : 0) : clamp((p - .34) / .66, 0, 1);

  const mobile = window.innerWidth <= 760;

  // Past the emblem's resting point the roots under the header keep
  // widening (--r) and fade to hidden before the hero eyebrow text
  // scrolls up to reach them. Mobile ramps earlier — the emblem is
  // already formed at ~160, so growth starts the moment roots show.
  const rStart = mobile ? 150 : 235;
  const r = reduceMotion ? (y > 90 ? 1 : 0) : clamp((y - rStart) / 300, 0, 1);

  // vars live on the root so siblings (hero roots, mobile menu) can read them
  const now = performance.now();
  const speed = Math.abs(y - prevY) / Math.max(1, now - prevT); // px/ms
  prevT = now;
  root.style.setProperty('--p', p.toFixed(4));
  root.style.setProperty('--grass', grass.toFixed(4));
  root.style.setProperty('--r', r.toFixed(4));

  // section roots: --lg grows 0→1 as each .tz-local travels up through
  // the viewport — same widening metaphor as the header's --r, per-section
  const vh = window.innerHeight;
  for(const sec of tzLocalSecs){
    const box = sec.getBoundingClientRect();
    const g = reduceMotion
      ? (box.top < vh && box.bottom > 0 ? 1 : 0)
      : clamp((vh * .8 - box.top) / (vh * .7), 0, 1);
    sec.style.setProperty('--lg', g.toFixed(4));
  }

  if(y > prevY){ if(dir !== 1){ dir = 1; dirAnchor = prevY; } }
  else if(y < prevY){ if(dir !== -1){ dir = -1; dirAnchor = prevY; } }
  const intent = Math.abs(y - dirAnchor) > 20;
  if(mobile){
    // first scroll starts the grow; genuinely heading back up past
    // HB_HIDE_Y — where the hero wordmark reappears — retracts it
    // iOS note: scrollY at the top is rarely exactly 0 — the rubber-band
    // bounce reports negatives and can rest on fractional values, so
    // "home" is anything <= 1px or it never fires
    const target = reduceMotion ? (y > 1 ? 1 : 0)
      : (y <= 1 ? 0
      : (dir === -1 && intent && y < HB_HIDE_Y ? 0
      : (y > 24 ? 1 : hbTarget)));
    if(target !== hbTarget){
      hbTarget = target;
      if(reduceMotion){
        hbValue = hbTarget;
        root.style.setProperty('--hb', hbValue);
        root.classList.toggle('tz-landed', hbValue >= 1);
      }else if(hbRaf === null){
        hbFrom = hbValue; hbStart = performance.now();
        hbDur = Math.max(220, HB_MS * Math.abs(hbTarget - hbValue)); // pace scales with distance
        hbRaf = requestAnimationFrame(hbTick);
      }
    }
    // keep --hb owned by JS whenever the tween isn't running — if it ever
    // falls back to --hb:var(--p), the header's top is scrubbed by scroll
    // and its first ~(1-p)*96px is missing off-screen. If the tween died
    // mid-flight, complete it here so the header can't rest half-dropped.
    if(hbRaf === null){
      if(hbValue !== hbTarget) hbValue = hbTarget;
      root.style.setProperty('--hb', hbValue.toFixed(4));
      root.classList.toggle('tz-landed', hbValue >= .999);
    }
    header.classList.toggle('tz-scrolled', hbValue > .6 || p > .46);

    // the emblem zone is binary — never let the page park mid-transition:
    // a scroll that began near the top glides down to the resting point;
    // an upward scroll inside the zone glides home to the hero. Strict
    // direction + small-step checks keep anchor jumps and jitter out,
    // and the post-carry cooldown ignores momentum tails.
    if(!reduceMotion && !snapActive && intent && !touching && speed < .6 && now > snapCoolUntil){
      if(dir === 1 && dirAnchor < 60 && y < SNAP_Y && (y - dirAnchor) < 300) launchSnap(SNAP_Y, y);
      else if(dir === -1 && y > 0 && y < SNAP_Y) launchSnap(0, y);
    }
  }else{
    root.style.removeProperty('--hb');
    root.classList.remove('tz-landed');
    header.classList.toggle('tz-scrolled', p > .46);
  }
  prevY = y;

  if(!reduceMotion && heroBrandWrap){
    const hp = clamp(y / 235, 0, 1);
    // mobile: the logo swells as it slides under the header, feeding the
    // canopy bloom — desktop keeps the gentle shrink
    const swell = mobile ? .12 : -.045;
    heroBrandWrap.style.transform = `translateY(${-26 * hp}px) scale(${1 + (swell * hp)})`;
    heroBrandWrap.style.opacity = `${1 - hp}`;
    heroBrandWrap.style.filter = `blur(${2 * hp}px)`;
  }
}

updateScrollState();
window.addEventListener('scroll', updateScrollState, {passive:true});
// the browser chrome collapsing fires resize on nearly every scroll —
// only real width changes should re-evaluate the scroll state
let lastWidth = window.innerWidth;
window.addEventListener('resize', () => {
  if(window.innerWidth !== lastWidth){ lastWidth = window.innerWidth; updateScrollState(); }
}, {passive:true});

// when the mobile browser chrome collapses, the VISUAL viewport shifts
// inside the layout viewport — fixed top:0 layers get parked under where
// the toolbar was (the header's top ~20-30px hides off-screen until the
// bar returns). --vvo carries that offset so every fixed emblem layer
// stays glued to the visible top edge instead.
const vv = window.visualViewport;
const syncViewportOffset = () => {
  // clamp to the real chrome-collapse range: iOS Safari spikes offsetTop
  // during the top rubber-band bounce / expanded URL bar (>104px would
  // drag the hidden header fully into view at page top)
  if(vv) root.style.setProperty('--vvo', Math.min(Math.max(vv.offsetTop,0),40).toFixed(1) + 'px');
};
if(vv){
  vv.addEventListener('scroll', syncViewportOffset, {passive:true});
  vv.addEventListener('resize', syncViewportOffset, {passive:true});
}
syncViewportOffset();

// trust strip — staggered fade-up on first scroll into view, with a
// count-up on numeric stats ("24+" counts 0→24). Non-numeric stats and
// reduced-motion users just fade in with their final values.
const trust = document.querySelector('.tz-trust');
if(trust){
  const easeOut = t => 1 - Math.pow(1 - t, 3);
  const counters = [...trust.querySelectorAll('.tz-trust-item strong')].map(el => {
    const m = el.textContent.trim().match(/^(\d+)(.*)$/);
    if(!m) return null;
    const target = parseInt(m[1], 10), suffix = m[2] || '';
    if(!reduceMotion && target > 0) el.textContent = '0' + suffix;
    return {el, target, suffix};
  });
  const runTrust = () => {
    trust.classList.add('tz-in');
    if(reduceMotion) return;
    counters.forEach(c => {
      if(!c) return;
      const start = performance.now(), dur = 1400;
      const tick = now => {
        const t = Math.min(1, (now - start) / dur);
        c.el.textContent = Math.round(c.target * easeOut(t)) + c.suffix;
        if(t < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    });
  };
  if(reduceMotion || !('IntersectionObserver' in window)){
    runTrust();
  }else{
    new IntersectionObserver((entries, obs) => {
      if(entries.some(e => e.isIntersecting)){ obs.disconnect(); runTrust(); }
    }, {threshold:.35}).observe(trust);
  }
}

// why-us accordion — opening one item closes the others
document.querySelectorAll('.tz-acc-item').forEach(item => {
  item.addEventListener('toggle', () => {
    if(!item.open) return;
    item.closest('.tz-acc')?.querySelectorAll('.tz-acc-item[open]').forEach(other => {
      if(other !== item) other.open = false;
    });
  });
});

// FAQ topic filter — pill clicks show only that category's items
const faqPills = document.getElementById('faqPills');
const faqList = document.getElementById('faqList');
if(faqPills && faqList){
  const faqEmpty = document.getElementById('faqEmpty');
  faqPills.addEventListener('click', e => {
    const btn = e.target.closest('.tz-pill');
    if(!btn) return;
    faqPills.querySelectorAll('.tz-pill').forEach(p => p.classList.toggle('tz-active', p === btn));
    const topic = btn.dataset.topic;
    let shown = 0;
    faqList.querySelectorAll('.tz-faq-item').forEach(item => {
      const show = topic === 'all' || item.dataset.topic === topic;
      item.classList.toggle('tz-hide', !show);
      if(show) shown++;
    });
    if(faqEmpty) faqEmpty.hidden = shown > 0;
  });
}

// mobile menu drawer
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const drawerVeil = document.getElementById('drawerVeil');
const drawerClose = document.getElementById('drawerClose');
if(menuBtn && mobileMenu){
  // re-mark "current" client-side — whatever PHP emitted (real menu or
  // fallback), the drawer reflects the page you're actually on. Exact
  // path + hash match, so '/#services' lights Services, never Home.
  const drawerNav = mobileMenu.querySelector('.tz-drawer-nav');
  if(drawerNav){
    const here = location.pathname.replace(/\/?$/, '/');
    drawerNav.querySelectorAll('a').forEach(a => {
      const u = new URL(a.href, location.href);
      a.classList.toggle('tz-current',
        u.pathname.replace(/\/?$/, '/') === here && u.hash === location.hash);
    });
  }
  const setMenu = open => {
    mobileMenu.classList.toggle('tz-open', open);
    menuBtn.classList.toggle('tz-open', open);
    menuBtn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    if(drawerVeil) drawerVeil.classList.toggle('tz-open', open);
    menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    root.style.overflow = open ? 'hidden' : ''; // lock the page behind the drawer
  };
  const closeMenu = () => setMenu(false);
  menuBtn.addEventListener('click', () => setMenu(!mobileMenu.classList.contains('tz-open')));
  if(drawerClose) drawerClose.addEventListener('click', closeMenu);
  if(drawerVeil) drawerVeil.addEventListener('click', closeMenu);
  window.addEventListener('keydown', e => { if(e.key === 'Escape') closeMenu(); });
  mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
    snapCoolUntil = performance.now() + 2000; // let the anchor jump land — no assist
    closeMenu();
  }));
  window.addEventListener('scroll', closeMenu, {passive:true});
}
