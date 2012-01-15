<% if Items %>
<div id="accordion_{$ID}">
    <% control Items %>
    $Item
    <% end_control %>
</div>
<% else %>
<p>Keine Einträge vorhanden</p>
<% end_if %>