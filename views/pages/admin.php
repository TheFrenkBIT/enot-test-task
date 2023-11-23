
<main class="form-signin w-100 m-auto">
    <div>
        <?php /** @var TYPE_NAME $rates */
        foreach ($rates as $rate) { ?>
            <?php echo '<div style="display: flex; flex-direction: row; gap: 10px;">
                            <span>'.$rate['name'].'</span> 
                            <span>1 единица валюты = '.$rate['self_to_rub'].' руб</span>
                            <span>1 руб = '.$rate['rub_to_self'].' eдиниц в валюте</span>
                        </div>' ?>
        <?php } ?>
    </div>
</main>