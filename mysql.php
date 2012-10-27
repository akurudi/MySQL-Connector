<head>
<title>MySQL</title>
</head>
<body>
<?php
/**
 * @author    Adarsh Kurudi
 * @Uses      The class encapsulates functions allowing us to connect, select, insert, delete, update and disconnect using constructors and destructors.
 * @Version   1
 * @Access    Public
 */
class mysql
{
/** 
* @uses    Sets the environment of the transaction. 
* @access  private
* @var     String 
*/ 
	private $host; /**< private variable holding host value. */ 
	private $uname; /**< private variable holding username value. */ 
	private $pwd; /**< private variable holding password value. */ 
	private $db; /**< private variable holding database name value. */ 
	private $con; /**< private variable holding connection status. */ 
/**
 * Initializes values for the new object.
 *
 * The newely created object of type myclass is initialized with the values are passed as arguments.
 *
 * @param $hostarg
 *   A string containing the host name.
 * @param $unamearg
 *   A string containing the username.
 * @param $pwdarg
 *   A string containing the password.
 * @param $dbarg
 *   A string containing the database name.
 */
	function __construct($hostarg,$unamearg,$pwdarg,$dbarg)
    {
        $this->host=$hostarg;
		$this->uname=$unamearg;
		$this->pwd=$pwdarg;
		$this->db=$dbarg;
	} 
	
	function display()
	{
		echo "Credentials being used are:<br />Host: ".$this->host."<br />Username: ". $this->uname."<br />Password: ". $this->pwd;
	}
/**
 * Connects to the database.
 *
 * The function allows us to make a connection to the database and prints appropriate message to notify user about the connection.
 */
	function connect()
	{
		$this->con = mysql_connect($this->host,$this->uname,$this->pwd);
		if ($this->con)
		{
			echo "<br />";
			echo "Connection success!!";
		}
		else
		{
			echo "<br />";;
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db($this->db, $this->con);
	}
/**
 * Selects from the database.
 *
 * The function allows us to select rows from a database and print them from the fetched array of records.
 */
	function select()
	{
		$result = mysql_query("SELECT * FROM names");

		while($row = mysql_fetch_array($result))
		{
			echo "<br />";
			echo $row['id'] . " | " . $row['fname']. " | " . $row['lname']. " | " . $row['email'];
			echo "<br />";
		}
	}
/**
 * Updates the database.
 *
 * The function allows us to update a database with the given values.
 */
	function update()
	{
		mysql_query("UPDATE names SET email = 'xyz@abc.com'
WHERE fname = 'adam'");
	}
/**
 * Inserts records into the database.
 *
 * The function allows us to insert new rows in a database with the given values.
 */
	function insert()
	{
		mysql_query("INSERT INTO names (id, fname, lname, email)
VALUES ('2', 'peter', 'griffin', 'pete@gmail.com')");
	}
/**
 * Deletes records from the database.
 *
 * The function allows us to delete rows from the database which have the given values.
 */
	function delete()
	{
		mysql_query("DELETE FROM names WHERE lname='griffin'");
	}
/**
 * Destroys objects and disconnects from the database.
 *
 * The function destroys the objects created by the constructor and also closes the connection from the database. 
 */
	function __destruct()
	{
       mysql_close($this->con);
	}
}
//Creating a new object of type mysql.
$a = new mysql('localhost','root','','connect');
$a->display();
$a->connect();
$a->select();
$a->insert();
$a->delete();
$a->select();
?>
</body>
</html>