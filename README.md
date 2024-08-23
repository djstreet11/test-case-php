So we have different delivery services and each of them have own uniq list of fields and own uniq API

for implement universal structure we create base adapter with strict list of basic methods which will describe base functinality of
delivery systems (for example send, check ttn ...). So each delivery will have own adapter and will implement all methods 
of base adapter with own api flow, because each delivery have own rules in api flow, so each delivery adapter will have method "send"
but functionality inside will be uniq. for create/implement api requests there are Proxy for each delivery system api.

So for add new delivery system copy/past existing structure, write own adapter and proxy flow/requests. If we need to add 
more fields to send, just add them in DeliverySendRequest and use it in adapter and proxy
 

Q1: How will the code change if there are 15 couriers?

A1: for add more couriers just need to expend code in some place
- add name/slug to enum (app/Enums/Delivery.php)
- if delivery service have some specific / uniq fields, so add them in request (app/Http/Requests/DeliverySendRequest.php)
- add adapter file and proxy file for delivery service (app/Services/Api/Shippings/Gateways)




Q2 If the customer has a problem with the delivery of orders. Customer sends data, but courier service support says they are not receiving data from current service.

A2 for check this we can check log of delivery service api and find what data go to service api and what answer was from them, also we can add more logging places to have bigger control on data movement

