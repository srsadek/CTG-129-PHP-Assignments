document.getElementById("submit-btn").addEventListener("click", function(e){
    e.preventDefault();
    if (checkIfInputsAreCorrect()) {
        const form = document.getElementById("main-form");
        form.submit();
        return;
    }
    alert("Please enter values in all input boxes!!!");
});

function checkIfInputsAreCorrect(){
    const inputElements = document.getElementsByClassName("input-text");

    for (let index = 0; index < inputElements.length; index++) {
        const element = inputElements[index];
        if(element.value.trim() == ""){
            return false;
        }
    }
    return true;
}