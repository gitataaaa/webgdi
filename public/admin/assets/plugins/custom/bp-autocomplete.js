function bpAutocomplete(inp, data){
    /* data consist of:
    | url: '..json' return: id, name, desc
    | param: ['id': 'param 1', 'name': 'param 2', 'desc': 'param 3'] -> nama field dari url json
    | limit: integer
    | onClick: function()
    */
    var limitChar = data.limit ? data.limit : 1;
    var param = data.param;
    var newFunction = data.onClick;
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    
    inp.addEventListener("input", function(e) {
        e.preventDefault();
        var a, b, i, val = this.value;
        
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        
        if(val.length >= limitChar){
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            
            this.parentNode.appendChild(a);
            
            $.getJSON(data.url+'='+val, function(response){
                if(response.length > 0){
                    $.each(response, function(i, item){
                        var name = param ? response[i][param.name] : item.name;
                        b = document.createElement("DIV");
                        b.innerHTML = name;
                        if(param.description){
                            b.innerHTML += '<br/><small style="color: #666">'+response[i][param.description]+'</small>';
                        }
                        //b.innerHTML += "<input type='hidden' value='" + name + "'>";
                        b.addEventListener("click", function(e) {
                            inp.value = name; //this.getElementsByTagName("input")[0].value;
                            if(newFunction){
                                newFunction(item);
                            }
                            closeAllLists();
                        });
                        a.appendChild(b);
                    })
                }else{
                    b = document.createElement("DIV");
                    b.innerHTML = 'Data tidak ditemukan';
                    b.addEventListener("click", function(e) {
                        inp.value = '';
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            })
        }
        
        
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
        x[currentFocus].scrollIntoView({behavior: "smooth", block: "nearest", inline: "nearest"});
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
            x[i].parentNode.removeChild(x[i]);
        }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}