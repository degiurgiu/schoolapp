/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
document.addEventListener("DOMContentLoaded", function(){
    $('#getStudent').click(function(){
        $.get('getStudent',function(data){
            $('#getStudentData').append(data);
            console.log(data);
        });
    });
    
});