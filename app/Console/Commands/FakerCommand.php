<?php namespace App\Console\Commands;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Helper\ProgressBar;

class FakerCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:fake-content {--section=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a fake content';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): bool
    {
        if (!is_null($this->option('section'))) {

            if ($this->confirm('Do you want to fill the page with test posts?')) {
                $count = $this->ask('How many entries should I add?', 10);

                $bar = $this->output->createProgressBar($count);
                $bar->setBarCharacter('<comment>=</comment>');
                $bar->setEmptyBarCharacter('-');
                $bar->setProgressCharacter('>');

                $bar->start();

                $faker = Factory::create();

                for ($i = 0; $i < $count; $i++) {
                    $id = DB::table('news')->insertGetId([
                        "section_id" => $this->option('section'),
                        "good_ru" => true,
                        "title_ru" => $faker->paragraph(rand(1, 3)),
                        "short_ru" => $faker->text,
                        "full_ru" => $faker->realText(),
                        "published_at" => $faker->dateTime,
                        "view" => $faker->randomNumber(5)
                    ]);

                    $image = "data/media/news/images/" . md5(Carbon::now() . $id) . ".jpg";

                    $file = File::copy("http://placeimg.com/640/480/nature", public_path($image));

                    if ($file) {
                        DB::table('media')->insert([
                            "section_id" => $this->option('section'),
                            "news_id" => $id,
                            "type" => "image",
                            "sind" => 1,
                            "link" => $image,
                            "title_ru" => $faker->name,
                            "publish_at" => $faker->dateTime,
                        ]);
                    }

                    $bar->advance();
                }

                $bar->finish();

                $this->newLine();

                return $this->info("Added ". $count ." test records") ?? true;
            }

            return $this->comment("Section not specified") ?? true;
        }

        return true;
    }

}
