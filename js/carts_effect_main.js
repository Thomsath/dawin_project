 
 function bg(elem,sens,vitesse){
    elem=="body" ? this.elem=document.body : this.elem=document.getElementById(elem)
    this.sens=sens;
    this.vitesse=vitesse;
    var that=this;
    document.documentElement.addEventListener("mousemove",function(event){that.mv(event)},false);
  }
  bg.prototype.mv = function(s){
    var dde=(navigator.vendor) ? document.body : document.documentElement;
    var setY = this.sens=="gauche" ? -(s.clientY + dde.scrollTop) : s.clientY + dde.scrollTop;
    this.elem.style.backgroundPosition='0px '+(setY/this.vitesse)+'px';
  }
  function init(){
    new bg("body","gauche",20);
  }
  window.addEventListener("load",init,false);