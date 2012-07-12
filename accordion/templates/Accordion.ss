<% if Items %>
<div id="accordion_{$ID}">
    <% loop Items %>
    $Item
    <% end_loop %>
</div>
<% else %>
<p>Keine Einträge vorhanden</p>
<% end_if %>