<footer class="s-footer">
  <?php
  // Promoted titles - Only show at the homepage
  if(  !( isset($_GET['search']) || isset($_GET['title']) || isset($_GET['keywords']) || isset($_GET['p']) ) ) :
    // query top book
    $topbook = $dbs->query('SELECT biblio_id, title, image FROM biblio WHERE
        promoted=1 ORDER BY last_update LIMIT 30');
    if ($num_rows = $topbook->num_rows) :
    ?>
    <!-- Featured
    ============================================= -->
    <div class="s-feature-content animated fadeInUp delay9">
    <div class="s-feature-list" itemscope itemtype="http://schema.org/Book" vocab="http://schema.org/" typeof="Book">
      <ul id="topbook" class="jcarousel-skin-tango">
        <?php
          while ($book = $topbook->fetch_assoc()) :
            $title = explode(" ", $book['title']);
            if (!empty($book['image'])) : ?>
            <li class="book">
              <a itemprop="name" property="name" href="./index.php?p=show_detail&amp;id=<?php echo $book['biblio_id'] ?>" title="<?php echo $book['title'] ?>">
                <img itemprop="image" src="images/docs/<?php echo $book['image'] ?>" alt="<?php echo $book['title'] ?>" />
              </a>
            </li>
            <?php else: ?>
            <li class="book">
              <a itemprop="name" property="name" href="./index.php?p=show_detail&amp;id=<?php echo $book['biblio_id'] ?>" title="<?php echo $book['title'] ?>">
                <div class="s-feature-title"><?php echo $title[0].'<br/>'.$title[1] ?><br/>...</div>
                <img itemprop="image" src="./template/splash/img/book.png" alt="<?php echo $book['title'] ?>" />
              </a>
            </li>
            <?php 
            endif;
          endwhile;
        ?>
      </ul>
    </div>
    </script>
    </div>
    <?php endif; ?>
  <?php endif; ?>
    <div class="row">
      <div class="col-lg-12 col-sm-12 col-xs-12">
    <?php
    $content = $dbs->query('SELECT content_id,content_title,content_path FROM content WHERE
        is_news IS NOT NULL ORDER BY last_update LIMIT 0,5');
    $a = '<ul id="listticker">';
      foreach ($content as $key) {
        $a .= '<li><a class="berita" href="index.php?p='.$key['content_path'].'">'.$key['content_title'].'</a></li>';
    }
    $a .= '</ul>';
    echo $a;
        ?>
      </div>
    </div>
  <div class="s-footer-content container"> 
    <div class="row">
      <div class="col-lg-6 col-sm-3 col-xs-12">
        <div class="s-footer-tagline">
          <a href="//slims.web.id" target="_blank"><?php echo SENAYAN_VERSION; ?></a>

        </div>
      </div>
      <nav class="col-lg-6 col-sm-9 col-xs-12">
        <ul class="s-footer-menu">
          <li><a href="index.php"><?php echo __('Home'); ?></a></li>
          <li><a target="_blank" rel="archives" href="http://www.facebook.com/groups/senayan.slims">Facebook</a></li>
          <li><a target="_blank" rel="archives" href="http://www.twitter.com/#!/slims_official">Twitter</a></li>
          <li><a target="_blank" rel="archives" href="http://www.youtube.com/user/senayanslims">Youtube</a></li>
          <li><a target="_blank" rel="archives" href="http://www.github.com/slims">Github</a></li>
          <li><a target="_blank" rel="archives" href="www.slims.web.id/forum">Forum</a></li>
          <li><a target="_blank" rel="archives" href="index.php?rss=true" title="RSS" class="rss" >RSS</a></li>
        </ul>
      </nav>
    </div>
  </div>
</footer>

<style type="text/css">
.berita{
  color:white !important;
}
.berita:hover{
  text-decoration: underline !important;
}
#listticker{
  background-color: rgba(176, 209, 225, 0.65);
  height:50px;
  overflow:hidden;
  padding-bottom: 13px;
}
#listticker li{
  padding:15px;
  list-style:none;
}
#listticker .news-text{
  display:block;
  font-size:11px;
  margin-top:2px;
}
ul{
  margin-bottom: 0px; 
}
</style>

<script type="text/javascript">
$(document).ready(function(){ 
  var first = 0;
  var speed = 500;
  var pause = 6000;
  
    function removeFirst(){
      first = $('ul#listticker li:first').html();
      $('ul#listticker li:first')
      .animate({opacity: 0}, speed)
      .fadeOut('slow', function() {$(this).remove();});
      addLast(first);
    }
    
    function addLast(first){
      last = '<li style="display:none">'+first+'</li>';
      $('ul#listticker').append(last)
      $('ul#listticker li:last')
      .animate({opacity: 1}, speed)
      .fadeIn('slow')
    }
  
  interval = setInterval(removeFirst, pause);
});</script>