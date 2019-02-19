<div id="single-blog" class="single-blog-warp">
    <div class="blog-feature-warp">
        <div class="detail-pic">
            
            <?php 
                $a = str_replace("http", "https", get_first_image($profil->content, 'big'));
                echo $a;
            ?>
        </div>
        <div style="margin-top: 25px;">
            <?= rmImg($profil->content) ?>
        </div>
    </div>
</div>
