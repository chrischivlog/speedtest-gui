<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/css/uikit.min.css" />
<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.11.1/dist/js/uikit-icons.min.js"></script>
<?php 

$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    if($host == '/test'){
        ?>
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><b>Test System</b></p>
            </div>
        <?php
    }else{
        ?>
            <div class="uk-alert-primary" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p><b>produktiv</b></p>
            </div>
        <?php
    }

?>

<meta http-equiv="refresh" content="30">
<div class="uk-container">
                    <table class="uk-table uk-table-divider">
    <thead>
        <tr>
            <th>Datum</th>
            <th>Latenz</th>
            <th>Download</th>
            <th>Upload</th>
            <th>Internet Service Provider</th>
            <th>Externe IP</th>
            <th>Host</th>
            <th>URL mit Ergebniss</th>
            <th>Paket verlust</th>
        </tr>
    </thead>

<?php

if ($handle = opendir('log')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            $log = file_get_contents('log/' . $entry);
            $obj = json_decode($log);

            $obj_timestamp = $obj->timestamp;
            $obj_latency = $obj->ping->latency;

            $obj_bandwidth_down =  $obj->download->bandwidth;
            $obj_bandwidth_up = $obj->upload->bandwidth;

            $obj_isp = $obj->isp;
            $obj_externalIp =  $obj->interface->externalIp;
            $obj_host =  $obj->server->host;
            $obj_name =  $obj->server->name;
            $obj_ip =  $obj->server->ip;
            $obj_url =  $obj->result->url;
            $obj_packetLoss = $obj->packetLoss;

            ///ausgabe

?><br>

    <tbody>
        <tr>
            <td><?php echo $obj_timestamp; ?></td>
            <td><?php echo $obj_latency; ?>ms</td>
            <td><?php echo round(($obj_bandwidth_down/'125000'), 2); ?> Mb/s</td>
            <td><?php echo round(($obj_bandwidth_up/'125000'), 2); ?> Mb/s</td>
            <td><?php echo $obj_isp; ?></td>
            <td><?php echo $obj_externalIp; ?></td>
            <td><?php echo $obj_host; ?></td>
            <td><a target="_blank" href="<?php echo $obj_url; ?>" >Ergebniss</a></td>
            <td><?php echo $obj_packetLoss; ?></td>
        </tr>

    </tbody>

                </div>
            </div>
<?php
        }
    }

    closedir($handle);
}

?>
</table>