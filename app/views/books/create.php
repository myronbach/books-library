<div class="w3-content w3-section" style="max-width:720px">
    <?php include(VIEWS.'/shared/errors.php')?>

    <div class="w3-card-4  w3-white">
        <div class="w3-row w3-padding w3-light-gray">
            <h2><?php if (isset($title)) {
                    echo $title;
                } ?></h2>
        </div>


        <div class="w3-card-4 ">

            <form action="/books/store" class="w3-container w3-padding-large" enctype="multipart/form-data" method="post">

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Title</b> </label>
                    <span class="w3-text-red">*<?php echo error('title');?></span>
                    <input class="w3-input" type="text" name="title" value="<?= data('title')?>"  required>

                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Author</b> </label>
                    <span class="w3-text-red">*<?php echo error('author');?></span>
                    <select class="w3-select w3-padding-16" name="author" >
                        <option value="" disabled selected><b></b></option>
                        <?php $id=data('author');?>
                        <?php foreach($authors as $author):?>
                            <option value="<?= $author['id']?>" <?php  if($id==$author['id']){echo 'selected';} ?> ><?= $author['first_name'].' ' .$author['last_name']?></option>
                        <?php endforeach;?>

                    </select>

                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Genre</b> </label>
                    <span class="w3-text-red">*<?php echo error('genre');?></span>
                    <select class="w3-select w3-padding-16" name="genre">
                        <option value="" disabled selected><b></b></option>
                        <?php $id=data('genre');?>
                        <?php foreach($genres as $genre):?>
                            <option value="<?= $genre['id']?>" <?php if($id == $genre['id']){echo 'selected';} ?>><?= $genre['genre']?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Language</b> </label>
                    <span class="w3-text-red">*<?php echo error('language');?></span>
                    <select class="w3-select w3-padding-16" name="language">
                        <option value="" disabled selected><b></b></option>
                        <?php $id=data('language');?>
                        <?php foreach($languages as $language):?>
                            <option value="<?= $language['id']?>" <?php if($id == $language['id']){echo 'selected';} ?>><?= $language['language']?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Year</b> </label>
                    <span class="w3-text-red">*<?php echo error('year');?></span>
                    <input class="w3-input" type="number" name="year" pattern="^[0-9]{4}$" value="<?= data('year') ?>">
                </div>
                <div class="w3-section">
                    <label class="w3-text-gray"><b>ISBN</b> </label>
                    <span class="w3-text-red">*<?php echo error('isbn');?></span>
                    <input class="w3-input" type="number" name="isbn" value="<?= data('isbn')?>">
                </div>
                <div class="w3-section">
                    <label class="w3-text-gray"><b>Image</b> </label>
                    <input class="w3-input" type="file" name="image">
                </div>
                <div class="w3-section">
                    <input class="w3-button w3-right w3-border w3-border-red  w3-text-teal" name="submit" type="submit" value="SEND">
                </div>

            </form>

        </div>


    </div>
</div>

