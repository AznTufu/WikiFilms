<section class="grid grid-cols-5 gap-6 mx-[150px] my-[50px] shadow-blue-500/50">
    <?php foreach ($films_ordered->results as $film){ ?>
        <div>
            <img src=" https://image.tmdb.org/t/p/w500<?php echo $film->backdrop_path ?>" alt="" >
            <h3><?php if (isset($film->title)){
                    echo $film->title;
                }
                elseif (isset($film->name)){
                    echo $film->name;
                }
                else{
                    echo 'title infound';
                }
               ?></h3>
            <p><?php $g=$film->genre_ids; $a=sizeof($g); $x=0;
                while($a > $x) {
                    $List_name=$api->NameGenreById($g);
                    $x++;
                }
                foreach ($List_name as $item) {
                    echo $item . ' ';
                }
                ?></p>
            <p>Popularity : <?php echo $film->popularity; ?></p>
            <p>Vote average : <?php echo $film->vote_average ?></p>
            <p>Date de sortie : <?php if (isset($film->release_date)){
                    echo $film->release_date;
                }
                elseif (isset($film->first_air_date)){
                    echo $film->first_air_date;
                }
                else{
                    echo 'release date infound';
                }
                 ?></p>
            <p>-18 : <?php if ($film->adult == Null) {
                echo 'No';
            }
            else{
                echo 'Yes';
                }?></p>
        </div>
    <?php } ?>
</section>