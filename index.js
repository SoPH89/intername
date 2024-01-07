const handleSubmit = async (event) => {
    event.preventDefault();

    const myForm = event.target;
    const formData = new FormData(myForm);
    console.log(formData)

    try {
        const response = await fetch("leads.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams(formData).toString(),
        });

        if (response.ok) {
            alert("Thank you " + formData.values.first_name + " " +  formData.values.last_name + " , we’ll contact you soon");
        } else {
            throw new Error(`Failed to submit form. Server returned ${response.status}`);
        }
    } catch (error) {
        console.error(error);
        alert("Error submitting the form. Please try again.");
    }
};

document
    .querySelector("#form") // Make sure to use the correct form selector
    .addEventListener("submit", handleSubmit);











// var modal = document.getElementById("myModal");

// // Get the button that opens the modal
// var btn = document.getElementById("submitBtn");

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks the button, open the modal 
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }

