<?php

error_reporting(E_ALL);

// Set time limit to indefinite execution
set_time_limit (0);

 ob_implicit_flush();

// Set the ip and port we will listen on
$address = '192.168.0.1';
$port = 10000;
$max_clients = 10;

// Array that will hold client information
$client = Array();

for($g=0;$g<$max_clients;$g++)
{
	$client[$g] = null;
}

// Pre-initiallize the client array.
//$client = array_fill(0,$max_clients,0);


if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
 }
 
 if (socket_bind($sock, $address, $port) === false) {
    echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
 }
 
 if (socket_listen($sock) === false) {
    echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
 }


// Create a TCP Stream socket
//$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
// Bind the socket to an address/port
//socket_bind($sock, $address, $port) or die('Could not bind to address');
// Start listening for connections

//socket_close($sock);
//socket_listen($sock);

// Loop continuously
while (true) {
    // Setup clients listen socket for reading
    $read[0] = $sock;
    for ($i = 0; $i < $max_clients; $i++)
    {
        //if ($client[$i]['sock']  !== null){
	if ($client[$i]  !== null){
	    $read[$i + 1] = $client[$i];
            //$read[$i + 1] = $client[$i]['sock'] ;
	}
    }
    // Set up a blocking call to socket_select()
    $ready = socket_select($read, $write = NULL, $except = NULL, $tv_sec = NULL);
    /* if a new connection is being made add it to the client array */
    if (in_array($sock, $client)) {
        for ($i = 0; $i < $max_clients; $i++)
        {
	    //if ($client[$i]['sock'] == null) {
            if ($client[$i] === null) {
                //$client[$i]['sock'] = socket_accept($sock);
		$client[$i] = socket_accept($sock);
		
		$greet = "\nWelcome to the Chimaera Vehicle Control Server. \n" .
        		"To quit, type 'quit'. To shut down the server type 'kill'.\n";
    		socket_write($client[$i],$greet,strlen($greet));	
		//echo "\nSocket Accepted in slot".$i."!\n";
		//echo $client[$i]['sock'];
                break;
            }
            elseif ($i === $max_clients )
                print ("too many clients");
        }
        if (--$ready <= 0)
            continue;
    } // end if in_array
    
    
    //socket_write($client[$i],$greet,strlen($greet));
    
    // If a client is trying to write - handle it now
    for ($i = 0; $i < $max_clients; $i++) // for each client
    {
        //if (in_array($client[$i] , $read))
	if($client[$i] !== null)
	{
            //$input = socket_read($client[$i]['sock'] , 1024);
	    echo "i am here";
	    $input=socket_read($client[$i], 1024, PHP_NORMAL_READ);
	    //$input = socket_read($client[$i], 1024);
            //if ($input == null) {
                // Zero length string meaning disconnected
                //unset($client[$i]);
            //}
	    //if($input === chr(10))
		echo "\n".$input."\n";
            //$n = trim($input);
	    if (!$input = trim($input)) {
	    //$input = trim($input)
            continue;
            }
            if ($input == 'kill') 
	    {
                // requested disconnect
		//socket_close($client[$i]['sock']);
                socket_close($client[$i]);
            } 
	    //else 
	    //{
                echo "not here";
		// strip white spaces and write back to user
                //$output = ereg_replace("[ \t\n\r]","",$input).chr(0);
		$output = "Helo".chr(10);
                socket_write($client[$i],$output,strlen($output));
		//socket_write($client[$i],$output,strlen($output));
            //}
        } 
	else 
	{
	    echo "here here";
            // Close the socket
            //socket_close($client[$i]['sock']);
	    //socket_close($client[$i]);
            unset($client[$i]);
        }
    }
} // end while
// Close the master sockets
socket_close($sock);

?> 