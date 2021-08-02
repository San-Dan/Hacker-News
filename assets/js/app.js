// DOES NOT WORK, KEPT THE EDIT COMMENT FORM VISIBLE AT ALL TIMES INSTEAD

// Show form for updating your own comments
// hade querySelector(All) först
// const editCommentBtns = document.querySelectorAll("toggle-form");
// const editForms = document.querySelectorAll("editCommentForm");

// // Edit Comment Toggle
// editCommentBtns.forEach((editCommentBtn) => {
//   editCommentBtn.addEventListener("click", () => {
//     editForms.forEach((editForm) => {
//       if (editForm.style.display === "none") {
//         editForm.classList.toggle("showEditForm");
//       }
//     });
//   });
// });

// Amandas TOGGLE ALT
// editCommentBtns.forEach((editCommentBtn) => {
//   editCommentBtn.addEventListener("click", () => {
//     editForms.forEach((form) => {
//       if (editCommentBtn.dataset.id === form.dataset.id) {
//         form.classList.toggle("show-edit");
//       }
//     });

//     comments.forEach((comment) => {
//       if (editCommentBtn.dataset.id === comment.dataset.id) {
//         comment.classList.toggle("hide-text");
//       }
//     });
//   });
// });

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

// alt 2 - MED FUNKTION. Funkade ibland men inte längre??

// function openForm() {
//   // let form = document.getElementsByClassName("editCommentForm");

//   if (form.style.display === "none") {
//     form.style.display = "block";
//   } else {
//     form.style.display = "none";
//   }
// }

// editCommentBtn.addEventListener("click", openForm());

// editCommentBtn.addEventListener("click", openForm());

//------------------------------

// Original - funkade inte
// openUpdateForm.addEventListener("click", ()=>{
//   form.style.display = "block";
// });

// LIKE button
// if focus make dark
