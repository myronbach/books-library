<div class="w3-content w3-section" style="max-width:720px">
    <div class="w3-card-4  w3-white">
        <div class="w3-row w3-padding w3-light-gray">
            <h2 class=""><?php if(isset($title)){echo $title;}?></h2>
        </div>


    <div class="w3-row-padding ">
        <div class=" w3-col w3-container w3-padding-48 w3-padding-large" style="width:250px">
                <img src="/uploads/images/books/<?= $book['image']?>" width="220px" alt="<?= $book['title']?>">
        </div>
        <div class="w3-rest  w3-container w3-padding-large">
                <ul class="w3-ul ">
                    <li>
                        <h4> <?= $book['title']?></h4>
                        <p><strong>Автор:</strong> <?= $book['first_name']?> <?= $book['last_name']?></p>
                    </li>
                    <li

                        <hз><strong>Жанр:</strong> <?= $book['genre']?></hз>
                    </li>
                    <li>
                        <p><strong>Мова:</strong> <?= $book['language']?></p>

                    </li>
                    <li>
                        <p><strong>Рік видавництва:</strong> <?= $book['publication_date']?></p>

                    </li>
                    <li>

                        <p><strong>ISBN:</strong> <?= $book['isbn_number']?></p>
                    </li>
                </ul>

        </div>
        <hr>
    </div>

        <div class=" w3-padding-large">
            <a href="/books" class="w3-button w3-border w3-border-red  w3-text-deep-orange">BACK</a>
            <a href="/books/<?= $book['id']?>/edit" class="w3-button w3-border w3-border-red  w3-text-deep-orange">EDIT</a>

            <!--<button class="w3-bar-item w3-button w3-border w3-border-red w3-text-light-blue">BUTTON</button>-->

                <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-border w3-border-red  w3-text-deep-orange">DELETE</button>

                <div id="id01" class="w3-modal">
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:300px">

                        <div class="w3-center"><br>
                            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <h5> Are you shure?</h5>

                        </div>


                        <div class="w3-container w3-center w3-border-top w3-padding-16 w3-light-grey">
                            <form action="/books/<?= $book['id']?>/delete" method="post">
                                <input type="hidden" name="title" value="<?= $book['title']?>">
                                <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-teal">Cancel</button>
                                <button class="w3-button w3-red w3-section w3-padding" type="submit">Delete</button
                            </form>


                        </div>

                    </div>
                </div>



        </div>

    </div>
</div>

