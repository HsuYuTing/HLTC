<script language="javascript">
var XHreport = false;
if (window.XMLHttpRequest)
{
  XHreport = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
  XHreport = new ActiveXObject("Microsoft.XMLHTTP");
}

function XHreport_request(actionPage,send_str,returnEvent)
{
  var url =actionPage + "?mytimestamp="+new Date().getTime();
  if(XHreport){
    XHreport.open("POST", url);
    XHreport.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //server 傳回值    
    XHreport.onreadystatechange = function(){
      if (XHreport.readyState == 4){
        if (XHreport.status == 200){
          if (XHreport.responseText != "")
          {
             //alert(XHreport.responseText);
             myarr=XHreport.responseText.split("[!@#]");
                for(kk=0;kk<myarr.length;kk++){
                   //<table> 前面帶 要存取的名稱
                   //alert(myarr[kk]);
                   myint=myarr[kk].indexOf("<",0);
                   if (myint > 0 ){//HTML格式
                      var DivName=myarr[kk].substr(0,myint);
                      activeObj=document.getElementById(DivName);
                      var innstr=myarr[kk];
                      if(activeObj){ 
                    	//alert(innstr.substring(myint,innstr.length));
                        activeObj.innerHTML=innstr.substring(myint,innstr.length);
                        //alert(activeObj.innerHTML);
                      }else{
                          if(DivName=='error_msgbox'){ 
                            errorStr=innstr.substring(myint+1,innstr.length);
                            alert(errorStr); 
                            window.focus();                            
                          }//error_msgbox
                      }                      
                  }else{// end html
                       //後端錯誤訊息
                       if (myarr[kk].length > 0 && myarr[kk].length!=2){
                         alert("error: " + myarr[kk] + ",strlen=" + myarr[kk].length);
                       }
                    }
                }//end kk
          }
          if (returnEvent!= ""){ //最後要執行的 function 名稱
            var returnEventStr=returnEvent + "()";
            setTimeout(returnEventStr,10);
          }
        }else{
          //alert("伺服端錯誤訊息:" + XHreport.status );
        }       
       
      } //end 傳回狀態
    }// end server 傳回值       
    //送回伺服端的資料
    XHreport.send(send_str);  
     
  }//XMLobj=true  
}

//列舉 form 中的元件,串 url 字串
function XH_get_value(myformObj)
{
  var returnStr="";
  for (i=0;i<myformObj.elements.length;i++)
  {
    switch(myformObj.elements[i].type){
      case "text" :
         returnStr=returnStr + myformObj.elements[i].name + "=" + encodeURIComponent(myformObj.elements[i].value) + "&" ;
         break;
      case "password" :
         returnStr=returnStr + myformObj.elements[i].name + "=" + encodeURIComponent(myformObj.elements[i].value)  + "&" ;
         break;
      case "textarea" :
         returnStr=returnStr + myformObj.elements[i].name + "=" + encodeURIComponent(myformObj.elements[i].value)  + "&" ;
         break;
      case "hidden" :
         returnStr=returnStr + myformObj.elements[i].name + "=" + encodeURIComponent(myformObj.elements[i].value)  + "&" ;
         break;
      case "select-one" :
         returnStr=returnStr + myformObj.elements[i].name + "=" + encodeURIComponent(myformObj.elements[i].value)  + "&" ;
         break;
      case "radio" :
         if (myformObj.elements[i].checked==true)
         {returnStr=returnStr + myformObj.elements[i].name + "=" + encodeURIComponent(myformObj.elements[i].value)  + "&" ;}
         break;
      case "checkbox" :
         if (myformObj.elements[i].checked==true)
         {returnStr=returnStr + myformObj.elements[i].name + "=" + encodeURIComponent(myformObj.elements[i].value)  + "&" ;}
         break;
    } 
  }// end for
  return returnStr;
}

function XH_form_reset(formObj)
{
	var i=0;
	if(!formObj){ 
		alert("reset form not find"); 
		return; 
	}
  for (i=0;i<formObj.elements.length;i++)
  {
     if (formObj.elements[i].type=='text' || formObj.elements[i].type=='textarea' || formObj.elements[i].type=='hidden' ||  formObj.elements[i].type=='password') 
     {
        formObj.elements[i].value="";
     }
     else if (formObj.elements[i].type=='radio' || formObj.elements[i].type=='checkbox')
     {
        formObj.elements[i].checked=false;
     }
  }//for i
}
</script>