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

            $name = "Diane Douglas";//youre my client so I dont get confused ;)
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

        // function test_getAll()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //     $name = "Barbara";
        //     $id = 1;
        //     $test_stylist2 = new Client($name, $id);
        //
        //
        //     //Act
        //     $test_stylist->save();
        //     $test_stylist2->save();
        //
        //     //Assert
        //     $result = Client::getAll();
        //     $this->assertEquals([$test_stylist, $test_stylist2], $result);
        // }
        //
        // function test_deleteAll()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //     $name = "Barbara";
        //     $id = 1;
        //     $test_stylist2 = new Client($name, $id);
        //
        //     //Act
        //     $test_stylist->save();
        //     $test_stylist2->save();
        //     Client::deleteAll();
        //
        //     //Assert
        //     $result = Client::getAll();
        //     $this->assertEquals([], $result);
        // }
        //
        // protected function tearDown()
        // {
        //     Client::deleteAll();
        // }
        //
        // function test_getId()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //
        //     //Act
        //     $result = $test_stylist->getId();
        //
        //     //Assert
        //     $this->assertEquals($id, $result);
        // }
        //
        // function test_setId()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //
        //     //Act
        //     $test_stylist->setId(2);
        //     $result = $test_stylist->getId();
        //
        //     //Assert
        //     $this->assertEquals(2, $result);
        // }
        //
        //
        // function test_find()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //     $test_stylist->save();
        //
        //     //Act
        //     $result = Client::find($test_stylist->getId());
        //
        //     //Assert
        //     $this->assertEquals($test_stylist, $result);
        // }
        //
        // function test_Update()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //     $test_stylist->save();
        //     $new_name = "Barbara";
        //
        //     //Act
        //     $test_stylist->update($new_name);
        //
        //     //Assert
        //     $this->assertEquals("Barbara", $test_stylist->getName());
        // }
        //
        // function test_delete()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //     $test_stylist->save();
        //
        //     $name2 = "Barbara";
        //     $id2 = 2;
        //     $test_stylist2 = new Client($name2, $id2);
        //     $test_stylist2->save();
        //
        //     //Act
        //     $test_stylist->delete();
        //
        //     //Assert
        //     $this->assertEquals([$test_stylist2], Client::getAll());
        //
        // }
        //
        // function test_deleteClientByClient()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //     $test_stylist->save();
        //     $stylist_id = $test_stylist->getId();
        //
        //     $name = "Diane Douglas";
        //     $id = 1;
        //     $test_client = new Client($name, $id, $stylist_id);
        //     $test_client->save();
        //
        //     //Act
        //     $test_stylist->delete();
        //
        //     //Assert
        //     $this->assertEquals([], Client::getAll());
        // }
        //
        // function test_findClient()
        // {
        //     //Arrange
        //     $name = "Jill";
        //     $id = 1;
        //     $test_stylist = new Client($name, $id);
        //     $test_stylist->save();
        //     $stylist_id = $test_stylist->getId();
        //
        //
        //     $name = "Mels";
        //     $id = 1;
        //     $test_client = new Client($name, $id, $stylist_id);
        //     $test_client->save();
        //
        //     //Act.
        //     $found_client = $test_stylist->findClient();
        //
        //     //Assert
        //     $this->assertEquals([$test_client], $found_client);
        //
        // }



    }
?>
