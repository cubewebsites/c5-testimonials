<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php
$th = Loader::helper('text');
?>
<div class="block block-testimonials">
    <?php if($title): ?>
    <div class="block-title">
        <h3><?php echo $title ?></h3>
    </div>
    <?php endif ?>
    <div class="block-content">
        <div class="testimonial-list">
        <?php foreach($testimonials as $t): ?>
            <div class="item">
                <blockquote>
                    <p><?php echo $th->makenice($t->getQuote()) ?></p>
                    <?php if($t->getAuthor()):?>
                    <small>
                        <?php if($t->getUrl()): ?>
                        <a href="<?php echo $t->getUrl() ?>">
                        <?php endif ?>
                        
                        <?php echo $th->sanitize($t->getAuthor()) ?>
                        
                        <?php if($t->getUrl()): ?>
                        </a>
                        <?php endif ?>                       
                                             
                        <?php if($t->getDepartment()):?>
                        <br /><?php echo $th->sanitize($t->getDepartment()) ?>
                        <?php endif ?>
                    </small>
                    <?php endif ?>
                </blockquote>                
            </div>
        <?php endforeach ?>
        </div>
    </div>
</div>