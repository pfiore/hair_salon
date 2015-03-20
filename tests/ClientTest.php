<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');


    class ClientTest extends PHPUnit_Framework_TestCase
    {

        function test_getName()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";//youre my client so I dont get confused but its gonna happen anyway ;)
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);

            //Act
            $test_client->setName("Barbara");
            $result = $test_client->getName();

            //Assert
            $this->assertEquals("Barbara", $result);
        }

        function test_getStylistId()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals($stylist_id, $result);
        }

        function test_setStylistId()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Mels";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();

            //Act
            $test_client->setStylistId(99);
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals(99, $result);

        }

        function test_save()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);

            //Act
            $test_client->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals($test_client, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);

            $name = "Matt The Barbarian";
            $id = 2;
            $test_client2 = new Client($name, $id, $stylist_id);

            //Act
            $test_client->save();
            $test_client2->save();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);

            $name = "Matt The Barbarian";
            $id = 2;
            $test_client2 = new Client($name, $id, $stylist_id);

            //Act
            $test_client->save();
            $test_client2->save();
            Client::deleteAll();

            //Assert
            $result = Client::getAll();
            $this->assertEquals([], $result);
        }

        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);

            //Act
            $test_client->setId(2);
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }

        function test_update()
        {
            //Arrange
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Diane Douglas";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();
            $new_name = "Erica Veatch";

            //Act
            $test_client->update($new_name);

            //Assert
            $this->assertEquals("Erica Veatch", $test_client->getName());
        }

        function test_delete()
        {
            $name = "Jill";
            $id = 1;
            $test_stylist = new Stylist($name, $id);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $name = "Mels";
            $id = 1;
            $test_client = new Client($name, $id, $stylist_id);
            $test_client->save();

            $name2 = "Mcdonalds";
            $id2 = 2;
            $test_client2 = new Client($name2, $id2, $stylist_id);
            $test_client2->save();

            //Act
            $test_client->delete();

            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }
    }
?>
