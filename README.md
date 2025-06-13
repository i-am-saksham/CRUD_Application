# CRUD_Application

Technology Used:- PHP, Laravel and Bootstrap

Database:- MySQL

1] -------
   READ
   -------
   Go to /products->  
      There you will see the UI of the project-> 
       Main heading-> 
       Create button-> 
       Products form-> 
       and stored data which is in database if any
        
2] --------
   CREATE
   --------
  Click on Create button to add the product into the UI as well as in DB->
  After click, page will route to /products/create->
  and you will see Create Product form there->
  fill that form and click on Submit button ->
    After clicking submit button->
      page will route back to /products->
      and an success alert will come "Product Created Successfuly"->
      and product details will show on /products as well as in database->

Now you can Edit and Delete this product

3] -----
   Edit
   -----
   Click on Edit->
     page will route to /products/17/edit where 17 is the id of the product which you have selected->
     a form will be shown and you can make changes in your product and click on Update button->
     after clicking on update button, page will again redirect to /products and updated data will show upon UI as well as in database

4] --------
   DELETE
   --------
   After clicking delete button->
     a pop-up form will be shown which ask "Are you sure you want to delete this product?"->
     after clicking ok, your data will be deleted permanentely from the UI as well as from database.
