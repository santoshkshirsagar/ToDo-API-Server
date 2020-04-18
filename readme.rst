###################
To Do Item API server using CodeIgniter
###################

This code can be used to add/udpate/delete/list items

*******************
Database
*******************

Database sample file is in root folder todoitem.sql

**************************
Add Item
**************************

URL - {base-url}api/add
Method : POST
Body/Payload : {
	"title" : "title of the item"
}

**************************
Update Item
**************************

URL - {base-url}api/update
Method : PUT
Body/Payload : {
	"title" : "updated title of the item",
	"status" : "Pending/Done",
	"id" : 2
}


**************************
Delete Item
**************************

URL - {base-url}api/delte
Method : PUT
Body/Payload : {
	"id" : 2
}

**************************
List Items
**************************

URL - {base-url}api/list
Method : GET



