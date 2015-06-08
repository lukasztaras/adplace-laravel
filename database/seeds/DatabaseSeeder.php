<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            Model::unguard();

            $this->call('RolesTableSeeder');
            $this->call('TagsTableSeeder');
	}

}

class RolesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
             DB::table('roles')->delete();

             DB::table('roles')->insert(array(
                 array('name'=>'administrator'),
                 array('name'=>'advertiser')
              ));
	}
}

class TagsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
             DB::table('tags')->delete();

             DB::table('tags')->insert(array(
                 array(
                     'name' => 'color', 
                     'enabled' => 1),
                 array(
                     'name' => 'city', 
                     'enabled' => 1),
                 array(
                     'name' => 'hashtag', 
                     'enabled' => 1),
              ));
	}
}