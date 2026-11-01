<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Events';
require __DIR__ . '/includes/header.php';
?>
<h1>Campus events</h1>
<p class="lead">Search events by title, category, or description.</p>
<label for="event-search">Search events</label>
<input id="event-search" type="search" placeholder="Try workshop, sports, music…" autocomplete="off">
<p id="event-status" role="status" aria-live="polite">Loading events…</p>
<div id="event-list" class="tiles"></div>
<script>
const search = document.getElementById('event-search');
const list = document.getElementById('event-list');
const status = document.getElementById('event-status');
async function loadEvents() {
  status.textContent = 'Loading events…';
  try {
    const response = await fetch('api/events.php?q=' + encodeURIComponent(search.value));
    if (!response.ok) throw new Error('Request failed');
    const events = await response.json();
    list.replaceChildren();
    if (!events.length) { status.textContent = 'No events found.'; return; }
    status.textContent = events.length + ' event(s) found.';
    for (const event of events) {
      const card = document.createElement('article');
      card.className = 'panel';
      const title = document.createElement('h2'); title.textContent = event.title;
      const meta = document.createElement('p'); meta.textContent = event.category + ' · ' + event.event_date;
      const description = document.createElement('p'); description.textContent = event.description;
      card.append(title, meta, description); list.append(card);
    }
  } catch (error) { status.textContent = 'Could not load events. Check your database and try again.'; }
}
search.addEventListener('input', loadEvents);
loadEvents();
</script>
<?php require __DIR__ . '/includes/footer.php'; ?>
