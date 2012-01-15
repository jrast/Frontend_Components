<h3><a href="#">$TourName</a></h3>
    <div>
        <p>
            <b>Datum: </b> $Datum ($StartDatum.Ago bis zur Tour) <br />
            <% if Tourenblatt %>
                <b>Tourenblatt: </b><a href="$Tourenblatt.FileName" target="_blank">Download</a>
            <% end_if %>
        </p>
        <% include AnAbmelden %>
    </div>