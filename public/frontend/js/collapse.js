//Collapse Content Container 
let collapseContent = document.getElementsByClassName("coll-content")[0];
//Collapse Header (toggle button)
let collapseHeader = document.getElementsByClassName("coll-header")[0];
//Always Starts in Hidden Mode
collapseContent.style.visibility = "hidden";
//Custom Javascript (You can Implement it in a better way!) (ES6)
collapseHeader.onclick = () => {
  if(collapseContent.style.visibility == "hidden") {
    collapseContent.style.visibility = "visible";
    collapseContent.style.opacity = "1";
    collapseContent.style.maxHeight = "300px";
  } else if (collapseContent.style.visibility == "visible") {
    collapseContent.style.visibility = "hidden";
    collapseContent.style.opacity = "0";
    collapseContent.style.maxHeight = "0px";
  }
}