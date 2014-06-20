<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
        $this->command->info('User table seeded!');
		$this->call('PublicationTableSeeder');
        $this->command->info('Publication table seeded!');
		$this->call('DiscTableSeeder');
        $this->command->info('Disc table seeded!');
		$this->call('SongTableSeeder');
        $this->command->info('Song table seeded!');
	}

}

class SeederExtended extends Seeder {

	public $messages = array(
"You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder.",
"After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide...",
"and only five made it out. Now we took an oath, that I'm breaking now.",
"We said we'd say it was the snow that killed the other two, but it wasn't.",
"Nature is lethal but it doesn't hold a candle to man.",
"Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine.",
"You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke.ç",
"We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I.",
"We're on the same curve, just on opposite ends.",
    );

    public function randomes()
    {
    	return $this->messages[mt_rand(0, count($this->messages) - 1)];
    }
}


class UserTableSeeder extends SeederExtended {

    public function run()
    {
        // DB::table('users')->delete();

    	for ($i=1; $i <= 20; $i++) { 
        	User::create(array(
        	    'name' => 'Usuario Número ' . $i,
        	    'username' => 'usuario' . $i,
        	    'password' => '123456',
        	    'description' => $this->randomes(),
        	    'email' => 'foo' . $i . '@bar.com',
        	    'type' => mt_rand(0,2),
        	    'suscription' => mt_rand(0,2),
        		));
    		# code...
    	}
    }

}


class PublicationTableSeeder extends SeederExtended {

    public function run()
    {
        // DB::table('users')->delete();

    	for ($i=1; $i <= 100; $i++) { 
        	Publication::create(array(
        	    'user_id' => mt_rand(0,20),
        	    'content' => $this->randomes(),
        		));
    		# code...
    	}
    }

}


class DiscTableSeeder extends SeederExtended {

    public function run()
    {
        // DB::table('users')->delete();

    	for ($i=1; $i <= 20; $i++) { 
        	Disc::create(array(
        	    'user_id' => mt_rand(0,20),
        	    'name' => 'Disco número' . $i,
        		));
    		# code...
    	}
    }

}


class SongTableSeeder extends SeederExtended {

    public function run()
    {
        // DB::table('users')->delete();

    	for ($i=1; $i <= 20; $i++) { 
        	Song::create(array(
        	    'disc_id' => mt_rand(0,20),
        	    'name' => 'Disco número' . $i,
        	    'number' => '0',
        		));
    		# code...
    	}
    }

}
