<div class="w3-content w3-section" style="max-width:720px">
    <?php include(VIEWS.'/shared/errors.php')?>

    <div class="w3-card-4  w3-white">
        <div class="w3-row w3-padding w3-light-gray">
            <h2><?php if (isset($title)) {
                    echo $title;
                } ?></h2>
        </div>


        <div class="w3-card-4 ">

            <form action="/books/<?=$book['id']?>/update" class="w3-container w3-padding-large" enctype="multipart/form-data" method="post">

                <input type="hidden" name="id" value="<?= $book['id']?>">
                <div class="w3-section">
                    <label class="w3-text-gray"><b>Title</b> </label>
                    <span class="w3-text-red">*<?php echo error('title');?></span>
                    <input class="w3-input" type="text" name="title" value="<?= $book['title']?>"  required>

                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Author</b> </label>
                    <span class="w3-text-red">*<?php echo error('author');?></span>
                    <select class="w3-select w3-padding-16" name="author" >
                        <option value="" disabled selected><b></b></option>
                        <?php foreach($authors as $author):?>
                            <option value="<?= $author['id']?>" <?php  if($book['author_id']==$author['id']){echo 'selected';} ?> ><?= $author['first_name'].' ' .$author['last_name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Genre</b> </label>
                    <span class="w3-text-red">*<?php echo error('genre');?></span>
                    <select class="w3-select w3-padding-16" name="genre">
                        <option value="" disabled selected><b></b></option>
                        <?php foreach($genres as $genre):?>
                            <option value="<?= $genre['id']?>" <?php if($book['genre_id'] == $genre['id']){echo 'selected';} ?>><?= $genre['genre']?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Language</b> </label>
                    <span class="w3-text-red">*<?php echo error('language');?></span>
                    <select class="w3-select w3-padding-16" name="language">
                        <option value="" disabled selected><b></b></option>
                        <?php foreach($languages as $language):?>
                            <option value="<?= $language['id']?>" <?php if($book['language_id'] == $language['id']){echo 'selected';} ?>><?= $language['language']?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Year</b> </label>
                    <span class="w3-text-red">*<?php echo error('year');?></span>
                    <input class="w3-input" type="number" name="year" pattern="^[0-9]{4}$" value="<?= $book['publication_date'] ?>">
                </div>
                <div class="w3-section">
                    <label class="w3-text-gray"><b>ISBN</b> </label>
                    <span class="w3-text-red">*<?php echo error('isbn');?></span>
                    <input class="w3-input" type="number" name="isbn" value="<?= $book['isbn_number']?>">
                </div>

                <div class="w3-section">
                    <label class="w3-text-gray"><b>Image:</b> </label>
                    <div class="w3-section">
                        <img src="/uploads/images/books/<?php echo $book['image']; ?>" width="200" alt="" />

                    </div>
                    <input type="hidden" name="old_images" id="old_images" value="<?=$book['image']?>">

                </div>
                <div class="w3-section">
                    <label class="w3-text-gray"><b>New image:</b> </label>

                    <input class="w3-input" type="file" accept="image/jpeg" name="image" value="<?= $book['image']?>">
                </div>
                <div class="w3-section">
                    <input class="w3-button w3-right w3-border w3-border-red  w3-text-teal" name="submit" type="submit" value="SEND">
                </div>

            </form>

        </div>


    </div>
</div>



