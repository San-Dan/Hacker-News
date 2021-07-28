// Show form for updating your own comments

//ALT 1 - UTAN FUNKTION
// ger error: Cannot read property 'addEventListener' of null
// editCommentBtn.addEventListener("click", () => {
//   if (form.style.display === "none") {
//     form.style.display = "block";
//   } else {
//     form.style.display = "none";
//   }
// });
//-----------------------------------

// alt 2 - MED FUNKTION. Funkade ibland??

function openForm() {
  let form = document.getElementsByClassName("editCommentForm");

  if (form.style.display === "none") {
    form.style.display = "block";
  } else {
    form.style.display = "none";
  }
}
let editCommentBtn = document.getElementsByClassName("toggle-form");

editCommentBtn.addEventListener("click", openForm());

// editCommentBtn.addEventListener("click", openForm());

//------------------------------

// Original - funkade inte
// openUpdateForm.addEventListener("click", ()=>{
//   form.style.display = "block";
// });

// LIKE button
// if focus make dark
