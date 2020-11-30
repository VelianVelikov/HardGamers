var TINY={};

function T$(i){return document.getElementById(i)}
function T$$(e,p){return p.getElementsByTagName(e)}

TINY.slider=function(){
	function slide(n,p){this.n=n; this.init(p)}
	slide.prototype.init=function(p){
		var s=T$(p.id), u=this.u=T$$('ul',s)[0], c=T$$('li',u), l=c.length, i=this.l=this.c=0;
		if(p.navid&&p.activeclass){this.g=T$$('li',T$(p.navid)); this.s=p.activeclass}
		this.a=p.auto||0; this.p=p.resume||0; this.v=p.vertical||0; s.style.overflow='hidden';
		for(i;i<l;i++){if(c[i].parentNode==u){this.l++}}
		if(this.v){;
			u.style.top=0; this.h=p.height||c[0].offsetHeight; u.style.height=(this.l*this.h)+'px'
		}else{
			u.style.left=0; this.w=p.width||c[0].offsetWidth; u.style.width=(this.l*this.w)+'px'
		}
		this.pos(p.position||0,this.a?1:0)
	},
	slide.prototype.auto=function(){
		this.u.ai=setInterval(new Function(this.n+'.move(1,1)'),this.a*5000)
	},
	slide.prototype.move=function(d,a){
		var n=this.c+d, i=d==1?n==this.l?0:n:n<0?this.l-1:n; this.pos(i,a)
	},
	slide.prototype.pos=function(p,a){
		clearInterval(this.u.ai); clearInterval(this.u.si);
		var o=this.v?parseInt(this.u.style.top):parseInt(this.u.style.left),
		t=this.v?p*this.h:p*this.w, d=t>Math.abs(o)?1:-1; t=t*-1; this.c=p;
		if(this.g){for(var i=0;i<this.l;i++){this.g[i].className=i==p?this.s:''}}
		this.u.si=setInterval(new Function(this.n+'.slide('+t+','+d+','+a+')'),20)
	},
	slide.prototype.slide=function(t,d,a){
		var o=this.v?parseInt(this.u.style.top):parseInt(this.u.style.left);
		if(o==t){
			clearInterval(this.u.si); if(a||(this.a&&this.p)){this.auto()}
		}else{
			var v=o-Math.ceil(Math.abs(t-o)*.15)*d+'px';
			this.v?this.u.style.top=v:this.u.style.left=v
		}
	};
	return{slide:slide}
}();