<div class="w3-content w3-section" style="max-width:980px">
<div class="w3-card-4 " style="margin-top: 50px">
    <div class="w3-row w3-padding w3-light-gray">
        <h2><?php if(isset($title)){echo $title;}?></h2>
        <div class="w3-third">
            <input class="w3-input w3-animate-input "  type="text" style="width:150px" placeholder="Search for title.." id="myInput"
                   onkeyup="myFunction()">
        </div>

    </div>

    <table class="w3-table-all  w3-hoverable " id="myTable">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Language</th>
            <th>Date</th>
            <th>ISBN</th>

        </tr>

        <?php foreach ($books as $book): ?>
            <tr>
                <td><a href="/books/<?= $book['id']?>" class="links w3-text-teal w3-hover-text-red" ><?= $book['title'] ?></a> </td>
                <td><?= $book['first_name'] . ' ' . $book['last_name'] ?></td>
                <td><?= $book['genre'] ?></td>
                <td><?= $book['language'] ?></td>
                <td><?= $book['publication_date'] ?></td>
                <td><?= $book['isbn_number'] ?></td>

            </tr>
        <?php endforeach; ?>

    </table>
    <div class=" w3-padding-large">
        <a href="/books/create" class="w3-button w3-border w3-border-red  w3-text-deep-orange">CREATE</a>
        <!--<button class="w3-bar-item w3-button w3-border w3-border-red w3-text-light-blue">BUTTON</button>-->

    </div>
    <div class="w3-center w3-padding">
        <div class="w3-bar w3-border">
            <?php echo $pagination->get(); ?>
           <!-- <a href="#" class="w3-bar-item w3-button">&laquo;</a>
            <a href="#" class="w3-button">1</a>
            <a href="#" class="w3-button">2</a>
            <a href="#" class="w3-button">3</a>
            <a href="#" class="w3-button">4</a>
            <a href="#" class="w3-button">&raquo;</a>-->

        </div>
    </div>
</div>
</div>



