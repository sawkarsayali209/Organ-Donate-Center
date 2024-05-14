/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
 */

function toggleNav(){
    var sidenav=document.getElementById("sidenav");
    if(sidenav.style.left==="-250px")
    {
        sidenav.style.left="0";
        
    }
    else
    {
        sidenav.style.left="-250px";
    }
}
