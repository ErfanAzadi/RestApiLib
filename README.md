# RestApiLib
A simple RESTful API lib for php +7.4.0

#How to use?
Just take a look at <code>example.php</code> file to see the example.

#How does it work?
When a request is sendnig to your own script, It will checks the request's parameters and if the parameters were not empty, it will call the function <code>onReceiveRequest(array $request)</code> so you can easily extend your own class to the <code>class RestfulApiLib</code> and use that function to handle the requests more easier/better/cleaner!
