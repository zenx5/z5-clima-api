<?php
    $apikey = get_option('z5-clima-apikey','');
    $units = get_option('z5-clima-units','metric');
?>

<style>
    th{
        width:100px;
    }
    td {
        width: 300px;
    }
    input[type='number'] {
        text-align:right;
    }
    button {
        margin:10px;
        padding: 5px;
    }

</style>
<div>
    <h1>Options Clima</h1>
    <div>

    </div>

    <div class="container">
        <table>
            <tr>
                <th colspan="2">
                    <h3>General</h3>
                </th>
            </tr>
            <tr>
                <th>API Key:</th>
                <td><input id="apikey" type="text" value="<?=$apikey?>" min="1" style="width:100%;"/></td>
            </tr>
            <tr>
                <th>Units:</th>
                <td>
                    <select id="units" style="width:100%;">
                        <option value="standard" <?=$units==="standard" ? "selected" : "" ?> >Standard</option>
                        <option value="metric" <?=$units==="metric" ? "selected" : "" ?> >Metric</option>
                        <option value="imperial" <?=$units==="imperial" ? "selected" : "" ?> >Imperial</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <button id="save-options">Guardar</button>
                </th>
            </tr>
            <tr>
                <td>
                    <p>Obten tu apikey en https://openweathermap.org/</p>
                </td>
            </tr>
        </table>
    </div>
</div>
<script>
    const button = document.querySelector('#save-options')
    button.addEventListener('click', event => {
        const apikey = document.querySelector('#apikey').value
        const units = document.querySelector('#units').value
        
        fetch(`${ajaxurl}?action=save_options&apikey=${apikey}&units=${units}`)
            .then( response => response.json() )
            .then( result => {
                if(result) alert( 'Guardado' )
            } )

    })
</script>
