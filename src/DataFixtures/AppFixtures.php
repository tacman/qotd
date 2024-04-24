<?php

namespace App\DataFixtures;

use App\Entity\Qotd;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class AppFixtures extends Fixture
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')] private string $projectDir
    )
    {

    }
    public function load(ObjectManager $manager): void
    {
        $qotd = new Qotd(
            new \DateTimeImmutable('2023-05-12'),
            'https://example.com',
            <<<'EOTXT'
                    Hello

                    Message on line 1;
                    Message on line 2;
                    Message on line 3;
                    Message on line 4;

                    :speak_no_evil: :+1:

                    <https://joli-mapstr.vercel.app/> <https://joli-mapstr.vercel.app/>

                    <@UFV8NDFRS|Marion> <@UFV8NDFRS|Marion>

                    _foobar_

                    ~foobar~

                    * list 1
                    * list 2
                    * list 3

                    > quote


                    <script>alert('foo')</script>

                    ```
                    some code
                    ```

                    end
                EOTXT,
            'rich-text@example.com',
        );
        $manager->persist($qotd);

        $faker = \Faker\Factory::create();
        $faker->seed(42);

//        for ($i = 1; $i < 1000; ++$i) {
//            $qotd = new Qotd(
//                new \DateTimeImmutable("2023-05-12 -{$i} days"),
//                $faker->url(),
//                $faker->paragraph(3),
//                $faker->email(),
//            );
//            $qotd->vote = $faker->numberBetween(0, 100);
//            $manager->persist($qotd);
//        }

        // Add a gap between the first and the second QOTD
        // to test the SQL queries about the stats
        $qotd = new Qotd(
            new \DateTimeImmutable('2023-05-12 -1500 days'),
            'https://example.com',
            'This is a very old QOTD',
            'old@example.com',
        );

        // https://gist.githubusercontent.com/nasrulhazim/54b659e43b1035215cd0ba1d4577ee80/raw/e3c6895ce42069f0ee7e991229064f167fe8ccdc/quotes.json
        $quotes = json_decode(file_get_contents($this->projectDir . '/quotes.json'))->quotes;
        foreach ($quotes as $i => $quote) {
            $qotd = new Qotd(
                new \DateTimeImmutable("2023-05-12 -{$i} days"),
                $faker->url(),
                $quote->quote,
                $quote->author
            );
            $qotd->vote = rand(10, 99);
            $manager->persist($qotd);
        }

        $manager->flush();
    }
}
