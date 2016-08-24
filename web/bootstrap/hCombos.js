function hCombos(){
	this.ids  = [];
	this.info = {};
	this.num  = {};
	this.objs = [];
	this.pre  = [];
	this.ocupado = false;
	
	this.init = function(){
		var clase = this;
		var id, obj;
		for(var n = 0; n < this.ids.length; n++){
			id = this.ids[n];
			this.num[id] = n;
			obj = document.getElementById(id);
			if (n != this.ids.length - 1){
				obj.onchange = function(){
					if(clase.ocupado == false){
						clase.ocuapo == true;
						clase.change(this, this.id);
						clase.ocupado = false;
					}
				};
			}
			this.objs.push(obj);
		}
		this.refreshOpts(0, this.info);
		
		if (this.pre.length > 0){ 
			var combo, options;
			for(var n = 0; n < this.pre.length; n++){
				combo = this.objs[n];
				options = combo.getElementsByTagName("option");
				for(var m = 0; m < options.length; m++){
					if(options[m].value == this.pre[n]){
						options[m].selected = "selected";
						if (combo.onchange)	combo.onchange();
					}
				}
			}
		}
		
	};
	
	this.change = function(obj, id){
		var arbol = this.info;
		var numNivel = this.num[id];
		var arbolDes = '';
		var arbolId = '';
		var arbolHijo = {};
		var restantes = 0;

		for (var n = 0; n < this.ids.length; n++){
			arbolId = this.objs[n].value; 
			if(!arbolId){
				restantes = n + 1;
				break;
			}
			arbolDes = arbol[arbolId].des;
			
			if (n == numNivel){
				this.refreshOpts(n + 1, arbol[arbolId].values);
			}
			
			arbol = arbol[arbolId].values;
		}
		if(restantes < this.ids.length)
		for(var n = restantes; n < this.ids.length; n++){
			this.refreshOpts(n, {});
		}
	};
	
	this.refreshOpts = function(nCombo, valores){
		if (!this.objs[nCombo]) return;
		var combo = this.objs[nCombo];
		var preVal = combo.value;
		combo.innerHTML = '';
		
		var opt = this.newOpt('', '');
		combo.appendChild(opt);
		
		for(x in valores){
			opt = this.newOpt(x, valores[x].des);
			combo.appendChild(opt);
		}
	};
	
	this.newOpt = function(value, innerHTML){
		var opt = document.createElement('option');
		opt.value = value;
		opt.innerHTML = innerHTML;
		return opt;
	};
	
};

/* Developed by Herson Salinas, feel free to share */