<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class FilmsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $table = DB::table('films');
    $now =  Carbon::now();

    //Thor: Ragnarok
    $table->insert([
      'name'          => "Fantastic Beasts: The Crimes of Grindelwald",
      'slug'          => 'fantastic-beasts',
      'description'   => 'Magizoologist Newt Scamander joins forces with young Albus Dumbledore to prevent the devious Gellert Grindelwald from raising pure-blood wizards to rule over all non-magical beings.',
      'realease_date' => '16 November 2018',
      'rating'        => 5,
      'ticket_price'  => 3.50,
      'country_id'    => $this->getCountry('us')->id,
      'genre_id'      => $this->getGenre('drama')->id,
      'photo_id'      => $this->uploadPhoto('fantastic-beasts.jpg')->id,
      'created_at'    => $now,
    ]);

    //Blade Runner 2049
    $table->insert([
      'name'          => "Incredibles  2",
      'slug'          => 'incredibles-two',
      'description'   => "Everyone’s favorite family of superheroes is back in “Incredibles 2” – but this time Helen (voice of Holly Hunter) is in the spotlight, leaving Bob (voice of Craig T. Nelson) at home with Violet (voice of Sarah Vowell) and Dash (voice of Huck Milner) to navigate the day-to-day heroics of “normal” life. It’s a tough transistion for everyone, made tougher by the fact that the family is still unaware of baby Jack-Jack’s emerging superpowers. When a new villain hatches a brilliant and dangerous plot, the family and Frozone (voice of Samuel L. Jackson) must find a way to work together again—which is easier said than done, even when they’re all Incredible.",
      'realease_date' => '5 June 2018',
      'rating'        => 3,
      'ticket_price'  => 5.35,
      'country_id'    => $this->getCountry('uk')->id,
      'genre_id'      => $this->getGenre('sci-fi')->id,
      'photo_id'      => $this->uploadPhoto('incredibles-two.jpg')->id,
      'created_at'    => $now,
    ]);

    //Dunkirk
    $table->insert([
      'name'          => "The Nun",
      'slug'          => "the-nun-2018",
      'description'   => "When a young nun at a cloistered abbey in Romania takes her own life, a priest with a haunted past and a novitiate on the threshold of her final vows are sent by the Vatican to investigate. Together, they uncover the order's unholy secret. Risking not only their lives but their faith and their very souls, they confront a malevolent force in the form of a demonic nun",
      'realease_date' => '7 September 2018',
      'rating'        => 2,
      'ticket_price'  => 3.20,
      'country_id'    => $this->getCountry('us')->id,
      'genre_id'      => $this->getGenre('drama')->id,
      'photo_id'      => $this->uploadPhoto('dunkirk.jpg')->id,
      'created_at'    => $now,
    ]);

    //Logan
    $table->insert([
      'name'          => "Slender Man",
      'slug'          => "slender-man",
      'description'   => "Small-town best friends Hallie, Chloe, Wren and Katie go online to try and conjure up the Slender Man -- a tall, thin, horrifying figure whose face has no discernible features. Two weeks later, Katie mysteriously disappears during a class trip to a historic graveyard. Determined to find her, the girls soon suspect that the legend of the Slender Man may be all too real.",
      'realease_date' => ' 10 August 2018',
      'rating'        => 4,
      'ticket_price'  => 2.20,
      'country_id'    => $this->getCountry('us')->id,
      'genre_id'      => $this->getGenre('horror')->id,
      'photo_id'      => $this->uploadPhoto('slender-man.jpg')->id,
      'created_at'    => $now,
    ]);


  }

  /**
   * @param string $countryCode
   * @return \App\Country
   */
  private function getCountry(string $countryCode) {
    return \App\Country::where('code', '=', $countryCode)->firstOrFail();
  }

  /**
   * @param string $genreSlug
   * @return \App\Genre
   */
  private function getGenre(string $genreSlug) {
    return \App\Genre::where('slug', '=', $genreSlug)->firstOrFail();
  }

  /**
   * @param $filename
   * @return \App\Image
   */
  private function uploadPhoto($filename) {


    $ext = mb_strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $name = uniqid() . ".$ext";
    $imagePath = "/uploads/$name";

    $from = base_path("/movie-seeder/images/$filename");
    $dest = public_path($imagePath);

    File::copy($from, $dest);

    $image = new \App\Image();
    $image->path = $imagePath;
    $image->save();

    return $image;
  }

}
