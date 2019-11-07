# Abandon-Cart
This script will insert the data into a contact custom field for the AbandonCart task.

These are the expected data from the user: email
                                          cartsessionURL  
                                          firstname  
                                          lastname  
                                          orderitem1name  
                                          orderitem1imageURL  
                                          api_key / used for validating.  

(1)Received custom api key.

      The script will received an custom api key that's already in the script.

(2)The script will received contact info and order info.

     If the contact doesn't exist, it will create a contact base from the given  
     contact info and store the order info.

(3)If the contact exist.

    It will store the order info into the existing contact.

(4)Trigger the api call.


Developed by: Benjie

Check the script for more info.
