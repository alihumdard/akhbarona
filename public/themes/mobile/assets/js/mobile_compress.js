var Prototype={Version:'1.7',Browser:(function(){var ua=navigator.userAgent;var isOpera=Object.prototype.toString.call(window.opera)=='[object Opera]';return{IE:!!window.attachEvent&&!isOpera,Opera:isOpera,WebKit:ua.indexOf('AppleWebKit/')>-1,Gecko:ua.indexOf('Gecko')>-1&&ua.indexOf('KHTML')===-1,MobileSafari:/Apple.*Mobile/.test(ua)}})(),BrowserFeatures:{XPath:!!document.evaluate,SelectorsAPI:!!document.querySelector,ElementExtensions:(function(){var constructor=window.Element||window.HTMLElement;return!!(constructor&&constructor.prototype);})(),SpecificElementExtensions:(function(){if(typeof window.HTMLDivElement!=='undefined')
    return true;var div=document.createElement('div'),form=document.createElement('form'),isSupported=false;if(div['__proto__']&&(div['__proto__']!==form['__proto__'])){isSupported=true;}
    div=form=null;return isSupported;})()},ScriptFragment:'<script[^>]*>([\\S\\s]*?)<\/script>',JSONFilter:/^\/\*-secure-([\s\S]*)\*\/\s*$/,emptyFunction:function(){},K:function(x){return x}};if(Prototype.Browser.MobileSafari)
    Prototype.BrowserFeatures.SpecificElementExtensions=false;var Class=(function(){var IS_DONTENUM_BUGGY=(function(){for(var p in{toString:1}){if(p==='toString')return false;}
    return true;})();function subclass(){};function create(){var parent=null,properties=$A(arguments);if(Object.isFunction(properties[0]))
    parent=properties.shift();function klass(){this.initialize.apply(this,arguments);}
    Object.extend(klass,Class.Methods);klass.superclass=parent;klass.subclasses=[];if(parent){subclass.prototype=parent.prototype;klass.prototype=new subclass;parent.subclasses.push(klass);}
    for(var i=0,length=properties.length;i<length;i++)
        klass.addMethods(properties[i]);if(!klass.prototype.initialize)
        klass.prototype.initialize=Prototype.emptyFunction;klass.prototype.constructor=klass;return klass;}
    function addMethods(source){var ancestor=this.superclass&&this.superclass.prototype,properties=Object.keys(source);if(IS_DONTENUM_BUGGY){if(source.toString!=Object.prototype.toString)
        properties.push("toString");if(source.valueOf!=Object.prototype.valueOf)
        properties.push("valueOf");}
        for(var i=0,length=properties.length;i<length;i++){var property=properties[i],value=source[property];if(ancestor&&Object.isFunction(value)&&value.argumentNames()[0]=="$super"){var method=value;value=(function(m){return function(){return ancestor[m].apply(this,arguments);};})(property).wrap(method);value.valueOf=method.valueOf.bind(method);value.toString=method.toString.bind(method);}
            this.prototype[property]=value;}
        return this;}
    return{create:create,Methods:{addMethods:addMethods}};})();(function(){var _toString=Object.prototype.toString,NULL_TYPE='Null',UNDEFINED_TYPE='Undefined',BOOLEAN_TYPE='Boolean',NUMBER_TYPE='Number',STRING_TYPE='String',OBJECT_TYPE='Object',FUNCTION_CLASS='[object Function]',BOOLEAN_CLASS='[object Boolean]',NUMBER_CLASS='[object Number]',STRING_CLASS='[object String]',ARRAY_CLASS='[object Array]',DATE_CLASS='[object Date]',NATIVE_JSON_STRINGIFY_SUPPORT=window.JSON&&typeof JSON.stringify==='function'&&JSON.stringify(0)==='0'&&typeof JSON.stringify(Prototype.K)==='undefined';function Type(o){switch(o){case null:return NULL_TYPE;case(void 0):return UNDEFINED_TYPE;}
    var type=typeof o;switch(type){case'boolean':return BOOLEAN_TYPE;case'number':return NUMBER_TYPE;case'string':return STRING_TYPE;}
    return OBJECT_TYPE;}
    function extend(destination,source){for(var property in source)
        destination[property]=source[property];return destination;}
    function inspect(object){try{if(isUndefined(object))return'undefined';if(object===null)return'null';return object.inspect?object.inspect():String(object);}catch(e){if(e instanceof RangeError)return'...';throw e;}}
    function toJSON(value){return Str('',{'':value},[]);}
    function Str(key,holder,stack){var value=holder[key],type=typeof value;if(Type(value)===OBJECT_TYPE&&typeof value.toJSON==='function'){value=value.toJSON(key);}
        var _class=_toString.call(value);switch(_class){case NUMBER_CLASS:case BOOLEAN_CLASS:case STRING_CLASS:value=value.valueOf();}
        switch(value){case null:return'null';case true:return'true';case false:return'false';}
        type=typeof value;switch(type){case'string':return value.inspect(true);case'number':return isFinite(value)?String(value):'null';case'object':for(var i=0,length=stack.length;i<length;i++){if(stack[i]===value){throw new TypeError();}}
            stack.push(value);var partial=[];if(_class===ARRAY_CLASS){for(var i=0,length=value.length;i<length;i++){var str=Str(i,value,stack);partial.push(typeof str==='undefined'?'null':str);}
                partial='['+partial.join(',')+']';}else{var keys=Object.keys(value);for(var i=0,length=keys.length;i<length;i++){var key=keys[i],str=Str(key,value,stack);if(typeof str!=="undefined"){partial.push(key.inspect(true)+':'+str);}}
                partial='{'+partial.join(',')+'}';}
            stack.pop();return partial;}}
    function stringify(object){return JSON.stringify(object);}
    function toQueryString(object){return $H(object).toQueryString();}
    function toHTML(object){return object&&object.toHTML?object.toHTML():String.interpret(object);}
    function keys(object){if(Type(object)!==OBJECT_TYPE){throw new TypeError();}
        var results=[];for(var property in object){if(object.hasOwnProperty(property)){results.push(property);}}
        return results;}
    function values(object){var results=[];for(var property in object)
        results.push(object[property]);return results;}
    function clone(object){return extend({},object);}
    function isElement(object){return!!(object&&object.nodeType==1);}
    function isArray(object){return _toString.call(object)===ARRAY_CLASS;}
    var hasNativeIsArray=(typeof Array.isArray=='function')&&Array.isArray([])&&!Array.isArray({});if(hasNativeIsArray){isArray=Array.isArray;}
    function isHash(object){return object instanceof Hash;}
    function isFunction(object){return _toString.call(object)===FUNCTION_CLASS;}
    function isString(object){return _toString.call(object)===STRING_CLASS;}
    function isNumber(object){return _toString.call(object)===NUMBER_CLASS;}
    function isDate(object){return _toString.call(object)===DATE_CLASS;}
    function isUndefined(object){return typeof object==="undefined";}
    extend(Object,{extend:extend,inspect:inspect,toJSON:NATIVE_JSON_STRINGIFY_SUPPORT?stringify:toJSON,toQueryString:toQueryString,toHTML:toHTML,keys:Object.keys||keys,values:values,clone:clone,isElement:isElement,isArray:isArray,isHash:isHash,isFunction:isFunction,isString:isString,isNumber:isNumber,isDate:isDate,isUndefined:isUndefined});})();Object.extend(Function.prototype,(function(){var slice=Array.prototype.slice;function update(array,args){var arrayLength=array.length,length=args.length;while(length--)array[arrayLength+length]=args[length];return array;}
    function merge(array,args){array=slice.call(array,0);return update(array,args);}
    function argumentNames(){var names=this.toString().match(/^[\s\(]*function[^(]*\(([^)]*)\)/)[1].replace(/\/\/.*?[\r\n]|\/\*(?:.|[\r\n])*?\*\//g,'').replace(/\s+/g,'').split(',');return names.length==1&&!names[0]?[]:names;}
    function bind(context){if(arguments.length<2&&Object.isUndefined(arguments[0]))return this;var __method=this,args=slice.call(arguments,1);return function(){var a=merge(args,arguments);return __method.apply(context,a);}}
    function bindAsEventListener(context){var __method=this,args=slice.call(arguments,1);return function(event){var a=update([event||window.event],args);return __method.apply(context,a);}}
    function curry(){if(!arguments.length)return this;var __method=this,args=slice.call(arguments,0);return function(){var a=merge(args,arguments);return __method.apply(this,a);}}
    function delay(timeout){var __method=this,args=slice.call(arguments,1);timeout=timeout*1000;return window.setTimeout(function(){return __method.apply(__method,args);},timeout);}
    function defer(){var args=update([0.01],arguments);return this.delay.apply(this,args);}
    function wrap(wrapper){var __method=this;return function(){var a=update([__method.bind(this)],arguments);return wrapper.apply(this,a);}}
    function methodize(){if(this._methodized)return this._methodized;var __method=this;return this._methodized=function(){var a=update([this],arguments);return __method.apply(null,a);};}
    return{argumentNames:argumentNames,bind:bind,bindAsEventListener:bindAsEventListener,curry:curry,delay:delay,defer:defer,wrap:wrap,methodize:methodize}})());(function(proto){function toISOString(){return this.getUTCFullYear()+'-'+
    (this.getUTCMonth()+1).toPaddedString(2)+'-'+
    this.getUTCDate().toPaddedString(2)+'T'+
    this.getUTCHours().toPaddedString(2)+':'+
    this.getUTCMinutes().toPaddedString(2)+':'+
    this.getUTCSeconds().toPaddedString(2)+'Z';}
    function toJSON(){return this.toISOString();}
    if(!proto.toISOString)proto.toISOString=toISOString;if(!proto.toJSON)proto.toJSON=toJSON;})(Date.prototype);RegExp.prototype.match=RegExp.prototype.test;RegExp.escape=function(str){return String(str).replace(/([.*+?^=!:${}()|[\]\/\\])/g,'\\$1');};var PeriodicalExecuter=Class.create({initialize:function(callback,frequency){this.callback=callback;this.frequency=frequency;this.currentlyExecuting=false;this.registerCallback();},registerCallback:function(){this.timer=setInterval(this.onTimerEvent.bind(this),this.frequency*1000);},execute:function(){this.callback(this);},stop:function(){if(!this.timer)return;clearInterval(this.timer);this.timer=null;},onTimerEvent:function(){if(!this.currentlyExecuting){try{this.currentlyExecuting=true;this.execute();this.currentlyExecuting=false;}catch(e){this.currentlyExecuting=false;throw e;}}}});Object.extend(String,{interpret:function(value){return value==null?'':String(value);},specialChar:{'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','\\':'\\\\'}});Object.extend(String.prototype,(function(){var NATIVE_JSON_PARSE_SUPPORT=window.JSON&&typeof JSON.parse==='function'&&JSON.parse('{"test": true}').test;function prepareReplacement(replacement){if(Object.isFunction(replacement))return replacement;var template=new Template(replacement);return function(match){return template.evaluate(match)};}
    function gsub(pattern,replacement){var result='',source=this,match;replacement=prepareReplacement(replacement);if(Object.isString(pattern))
        pattern=RegExp.escape(pattern);if(!(pattern.length||pattern.source)){replacement=replacement('');return replacement+source.split('').join(replacement)+replacement;}
        while(source.length>0){if(match=source.match(pattern)){result+=source.slice(0,match.index);result+=String.interpret(replacement(match));source=source.slice(match.index+match[0].length);}else{result+=source,source='';}}
        return result;}
    function sub(pattern,replacement,count){replacement=prepareReplacement(replacement);count=Object.isUndefined(count)?1:count;return this.gsub(pattern,function(match){if(--count<0)return match[0];return replacement(match);});}
    function scan(pattern,iterator){this.gsub(pattern,iterator);return String(this);}
    function truncate(length,truncation){length=length||30;truncation=Object.isUndefined(truncation)?'...':truncation;return this.length>length?this.slice(0,length-truncation.length)+truncation:String(this);}
    function strip(){return this.replace(/^\s+/,'').replace(/\s+$/,'');}
    function stripTags(){return this.replace(/<\w+(\s+("[^"]*"|'[^']*'|[^>])+)?>|<\/\w+>/gi,'');}
    function stripScripts(){return this.replace(new RegExp(Prototype.ScriptFragment,'img'),'');}
    function extractScripts(){var matchAll=new RegExp(Prototype.ScriptFragment,'img'),matchOne=new RegExp(Prototype.ScriptFragment,'im');return(this.match(matchAll)||[]).map(function(scriptTag){return(scriptTag.match(matchOne)||['',''])[1];});}
    function evalScripts(){return this.extractScripts().map(function(script){return eval(script)});}
    function escapeHTML(){return this.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}
    function unescapeHTML(){return this.stripTags().replace(/&lt;/g,'<').replace(/&gt;/g,'>').replace(/&amp;/g,'&');}
    function toQueryParams(separator){var match=this.strip().match(/([^?#]*)(#.*)?$/);if(!match)return{};return match[1].split(separator||'&').inject({},function(hash,pair){if((pair=pair.split('='))[0]){var key=decodeURIComponent(pair.shift()),value=pair.length>1?pair.join('='):pair[0];if(value!=undefined)value=decodeURIComponent(value);if(key in hash){if(!Object.isArray(hash[key]))hash[key]=[hash[key]];hash[key].push(value);}
    else hash[key]=value;}
        return hash;});}
    function toArray(){return this.split('');}
    function succ(){return this.slice(0,this.length-1)+
        String.fromCharCode(this.charCodeAt(this.length-1)+1);}
    function times(count){return count<1?'':new Array(count+1).join(this);}
    function camelize(){return this.replace(/-+(.)?/g,function(match,chr){return chr?chr.toUpperCase():'';});}
    function capitalize(){return this.charAt(0).toUpperCase()+this.substring(1).toLowerCase();}
    function underscore(){return this.replace(/::/g,'/').replace(/([A-Z]+)([A-Z][a-z])/g,'$1_$2').replace(/([a-z\d])([A-Z])/g,'$1_$2').replace(/-/g,'_').toLowerCase();}
    function dasherize(){return this.replace(/_/g,'-');}
    function inspect(useDoubleQuotes){var escapedString=this.replace(/[\x00-\x1f\\]/g,function(character){if(character in String.specialChar){return String.specialChar[character];}
        return'\\u00'+character.charCodeAt().toPaddedString(2,16);});if(useDoubleQuotes)return'"'+escapedString.replace(/"/g,'\\"')+'"';return"'"+escapedString.replace(/'/g,'\\\'')+"'";}
    function unfilterJSON(filter){return this.replace(filter||Prototype.JSONFilter,'$1');}
    function isJSON(){var str=this;if(str.blank())return false;str=str.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,'@');str=str.replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']');str=str.replace(/(?:^|:|,)(?:\s*\[)+/g,'');return(/^[\],:{}\s]*$/).test(str);}
    function evalJSON(sanitize){var json=this.unfilterJSON(),cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;if(cx.test(json)){json=json.replace(cx,function(a){return'\\u'+('0000'+a.charCodeAt(0).toString(16)).slice(-4);});}
        try{if(!sanitize||json.isJSON())return eval('('+json+')');}catch(e){}
        throw new SyntaxError('Badly formed JSON string: '+this.inspect());}
    function parseJSON(){var json=this.unfilterJSON();return JSON.parse(json);}
    function include(pattern){return this.indexOf(pattern)>-1;}
    function startsWith(pattern){return this.lastIndexOf(pattern,0)===0;}
    function endsWith(pattern){var d=this.length-pattern.length;return d>=0&&this.indexOf(pattern,d)===d;}
    function empty(){return this=='';}
    function blank(){return /^\s*$/.test(this);}
    function interpolate(object,pattern){return new Template(this,pattern).evaluate(object);}
    return{gsub:gsub,sub:sub,scan:scan,truncate:truncate,strip:String.prototype.trim||strip,stripTags:stripTags,stripScripts:stripScripts,extractScripts:extractScripts,evalScripts:evalScripts,escapeHTML:escapeHTML,unescapeHTML:unescapeHTML,toQueryParams:toQueryParams,parseQuery:toQueryParams,toArray:toArray,succ:succ,times:times,camelize:camelize,capitalize:capitalize,underscore:underscore,dasherize:dasherize,inspect:inspect,unfilterJSON:unfilterJSON,isJSON:isJSON,evalJSON:NATIVE_JSON_PARSE_SUPPORT?parseJSON:evalJSON,include:include,startsWith:startsWith,endsWith:endsWith,empty:empty,blank:blank,interpolate:interpolate};})());var Template=Class.create({initialize:function(template,pattern){this.template=template.toString();this.pattern=pattern||Template.Pattern;},evaluate:function(object){if(object&&Object.isFunction(object.toTemplateReplacements))
    object=object.toTemplateReplacements();return this.template.gsub(this.pattern,function(match){if(object==null)return(match[1]+'');var before=match[1]||'';if(before=='\\')return match[2];var ctx=object,expr=match[3],pattern=/^([^.[]+|\[((?:.*?[^\\])?)\])(\.|\[|$)/;match=pattern.exec(expr);if(match==null)return before;while(match!=null){var comp=match[1].startsWith('[')?match[2].replace(/\\\\]/g,']'):match[1];ctx=ctx[comp];if(null==ctx||''==match[3])break;expr=expr.substring('['==match[3]?match[1].length:match[0].length);match=pattern.exec(expr);}
    return before+String.interpret(ctx);});}});Template.Pattern=/(^|.|\r|\n)(#\{(.*?)\})/;var $break={};var Enumerable=(function(){function each(iterator,context){var index=0;try{this._each(function(value){iterator.call(context,value,index++);});}catch(e){if(e!=$break)throw e;}
    return this;}
    function eachSlice(number,iterator,context){var index=-number,slices=[],array=this.toArray();if(number<1)return array;while((index+=number)<array.length)
        slices.push(array.slice(index,index+number));return slices.collect(iterator,context);}
    function all(iterator,context){iterator=iterator||Prototype.K;var result=true;this.each(function(value,index){result=result&&!!iterator.call(context,value,index);if(!result)throw $break;});return result;}
    function any(iterator,context){iterator=iterator||Prototype.K;var result=false;this.each(function(value,index){if(result=!!iterator.call(context,value,index))
        throw $break;});return result;}
    function collect(iterator,context){iterator=iterator||Prototype.K;var results=[];this.each(function(value,index){results.push(iterator.call(context,value,index));});return results;}
    function detect(iterator,context){var result;this.each(function(value,index){if(iterator.call(context,value,index)){result=value;throw $break;}});return result;}
    function findAll(iterator,context){var results=[];this.each(function(value,index){if(iterator.call(context,value,index))
        results.push(value);});return results;}
    function grep(filter,iterator,context){iterator=iterator||Prototype.K;var results=[];if(Object.isString(filter))
        filter=new RegExp(RegExp.escape(filter));this.each(function(value,index){if(filter.match(value))
        results.push(iterator.call(context,value,index));});return results;}
    function include(object){if(Object.isFunction(this.indexOf))
        if(this.indexOf(object)!=-1)return true;var found=false;this.each(function(value){if(value==object){found=true;throw $break;}});return found;}
    function inGroupsOf(number,fillWith){fillWith=Object.isUndefined(fillWith)?null:fillWith;return this.eachSlice(number,function(slice){while(slice.length<number)slice.push(fillWith);return slice;});}
    function inject(memo,iterator,context){this.each(function(value,index){memo=iterator.call(context,memo,value,index);});return memo;}
    function invoke(method){var args=$A(arguments).slice(1);return this.map(function(value){return value[method].apply(value,args);});}
    function max(iterator,context){iterator=iterator||Prototype.K;var result;this.each(function(value,index){value=iterator.call(context,value,index);if(result==null||value>=result)
        result=value;});return result;}
    function min(iterator,context){iterator=iterator||Prototype.K;var result;this.each(function(value,index){value=iterator.call(context,value,index);if(result==null||value<result)
        result=value;});return result;}
    function partition(iterator,context){iterator=iterator||Prototype.K;var trues=[],falses=[];this.each(function(value,index){(iterator.call(context,value,index)?trues:falses).push(value);});return[trues,falses];}
    function pluck(property){var results=[];this.each(function(value){results.push(value[property]);});return results;}
    function reject(iterator,context){var results=[];this.each(function(value,index){if(!iterator.call(context,value,index))
        results.push(value);});return results;}
    function sortBy(iterator,context){return this.map(function(value,index){return{value:value,criteria:iterator.call(context,value,index)};}).sort(function(left,right){var a=left.criteria,b=right.criteria;return a<b?-1:a>b?1:0;}).pluck('value');}
    function toArray(){return this.map();}
    function zip(){var iterator=Prototype.K,args=$A(arguments);if(Object.isFunction(args.last()))
        iterator=args.pop();var collections=[this].concat(args).map($A);return this.map(function(value,index){return iterator(collections.pluck(index));});}
    function size(){return this.toArray().length;}
    function inspect(){return'#<Enumerable:'+this.toArray().inspect()+'>';}
    return{each:each,eachSlice:eachSlice,all:all,every:all,any:any,some:any,collect:collect,map:collect,detect:detect,findAll:findAll,select:findAll,filter:findAll,grep:grep,include:include,member:include,inGroupsOf:inGroupsOf,inject:inject,invoke:invoke,max:max,min:min,partition:partition,pluck:pluck,reject:reject,sortBy:sortBy,toArray:toArray,entries:toArray,zip:zip,size:size,inspect:inspect,find:detect};})();function $A(iterable){if(!iterable)return[];if('toArray'in Object(iterable))return iterable.toArray();var length=iterable.length||0,results=new Array(length);while(length--)results[length]=iterable[length];return results;}
function $w(string){if(!Object.isString(string))return[];string=string.strip();return string?string.split(/\s+/):[];}
Array.from=$A;(function(){var arrayProto=Array.prototype,slice=arrayProto.slice,_each=arrayProto.forEach;function each(iterator,context){for(var i=0,length=this.length>>>0;i<length;i++){if(i in this)iterator.call(context,this[i],i,this);}}
    if(!_each)_each=each;function clear(){this.length=0;return this;}
    function first(){return this[0];}
    function last(){return this[this.length-1];}
    function compact(){return this.select(function(value){return value!=null;});}
    function flatten(){return this.inject([],function(array,value){if(Object.isArray(value))
        return array.concat(value.flatten());array.push(value);return array;});}
    function without(){var values=slice.call(arguments,0);return this.select(function(value){return!values.include(value);});}
    function reverse(inline){return(inline===false?this.toArray():this)._reverse();}
    function uniq(sorted){return this.inject([],function(array,value,index){if(0==index||(sorted?array.last()!=value:!array.include(value)))
        array.push(value);return array;});}
    function intersect(array){return this.uniq().findAll(function(item){return array.detect(function(value){return item===value});});}
    function clone(){return slice.call(this,0);}
    function size(){return this.length;}
    function inspect(){return'['+this.map(Object.inspect).join(', ')+']';}
    function indexOf(item,i){i||(i=0);var length=this.length;if(i<0)i=length+i;for(;i<length;i++)
        if(this[i]===item)return i;return-1;}
    function lastIndexOf(item,i){i=isNaN(i)?this.length:(i<0?this.length+i:i)+1;var n=this.slice(0,i).reverse().indexOf(item);return(n<0)?n:i-n-1;}
    function concat(){var array=slice.call(this,0),item;for(var i=0,length=arguments.length;i<length;i++){item=arguments[i];if(Object.isArray(item)&&!('callee'in item)){for(var j=0,arrayLength=item.length;j<arrayLength;j++)
        array.push(item[j]);}else{array.push(item);}}
        return array;}
    Object.extend(arrayProto,Enumerable);if(!arrayProto._reverse)
        arrayProto._reverse=arrayProto.reverse;Object.extend(arrayProto,{_each:_each,clear:clear,first:first,last:last,compact:compact,flatten:flatten,without:without,reverse:reverse,uniq:uniq,intersect:intersect,clone:clone,toArray:clone,size:size,inspect:inspect});var CONCAT_ARGUMENTS_BUGGY=(function(){return[].concat(arguments)[0][0]!==1;})(1,2)
    if(CONCAT_ARGUMENTS_BUGGY)arrayProto.concat=concat;if(!arrayProto.indexOf)arrayProto.indexOf=indexOf;if(!arrayProto.lastIndexOf)arrayProto.lastIndexOf=lastIndexOf;})();function $H(object){return new Hash(object);};var Hash=Class.create(Enumerable,(function(){function initialize(object){this._object=Object.isHash(object)?object.toObject():Object.clone(object);}
    function _each(iterator){for(var key in this._object){var value=this._object[key],pair=[key,value];pair.key=key;pair.value=value;iterator(pair);}}
    function set(key,value){return this._object[key]=value;}
    function get(key){if(this._object[key]!==Object.prototype[key])
        return this._object[key];}
    function unset(key){var value=this._object[key];delete this._object[key];return value;}
    function toObject(){return Object.clone(this._object);}
    function keys(){return this.pluck('key');}
    function values(){return this.pluck('value');}
    function index(value){var match=this.detect(function(pair){return pair.value===value;});return match&&match.key;}
    function merge(object){return this.clone().update(object);}
    function update(object){return new Hash(object).inject(this,function(result,pair){result.set(pair.key,pair.value);return result;});}
    function toQueryPair(key,value){if(Object.isUndefined(value))return key;return key+'='+encodeURIComponent(String.interpret(value));}
    function toQueryString(){return this.inject([],function(results,pair){var key=encodeURIComponent(pair.key),values=pair.value;if(values&&typeof values=='object'){if(Object.isArray(values)){var queryValues=[];for(var i=0,len=values.length,value;i<len;i++){value=values[i];queryValues.push(toQueryPair(key,value));}
        return results.concat(queryValues);}}else results.push(toQueryPair(key,values));return results;}).join('&');}
    function inspect(){return'#<Hash:{'+this.map(function(pair){return pair.map(Object.inspect).join(': ');}).join(', ')+'}>';}
    function clone(){return new Hash(this);}
    return{initialize:initialize,_each:_each,set:set,get:get,unset:unset,toObject:toObject,toTemplateReplacements:toObject,keys:keys,values:values,index:index,merge:merge,update:update,toQueryString:toQueryString,inspect:inspect,toJSON:toObject,clone:clone};})());Hash.from=$H;Object.extend(Number.prototype,(function(){function toColorPart(){return this.toPaddedString(2,16);}
    function succ(){return this+1;}
    function times(iterator,context){$R(0,this,true).each(iterator,context);return this;}
    function toPaddedString(length,radix){var string=this.toString(radix||10);return'0'.times(length-string.length)+string;}
    function abs(){return Math.abs(this);}
    function round(){return Math.round(this);}
    function ceil(){return Math.ceil(this);}
    function floor(){return Math.floor(this);}
    return{toColorPart:toColorPart,succ:succ,times:times,toPaddedString:toPaddedString,abs:abs,round:round,ceil:ceil,floor:floor};})());function $R(start,end,exclusive){return new ObjectRange(start,end,exclusive);}
var ObjectRange=Class.create(Enumerable,(function(){function initialize(start,end,exclusive){this.start=start;this.end=end;this.exclusive=exclusive;}
    function _each(iterator){var value=this.start;while(this.include(value)){iterator(value);value=value.succ();}}
    function include(value){if(value<this.start)
        return false;if(this.exclusive)
        return value<this.end;return value<=this.end;}
    return{initialize:initialize,_each:_each,include:include};})());var Abstract={};var Try={these:function(){var returnValue;for(var i=0,length=arguments.length;i<length;i++){var lambda=arguments[i];try{returnValue=lambda();break;}catch(e){}}
    return returnValue;}};var Ajax={getTransport:function(){return Try.these(function(){return new XMLHttpRequest()},function(){return new ActiveXObject('Msxml2.XMLHTTP')},function(){return new ActiveXObject('Microsoft.XMLHTTP')})||false;},activeRequestCount:0};Ajax.Responders={responders:[],_each:function(iterator){this.responders._each(iterator);},register:function(responder){if(!this.include(responder))
    this.responders.push(responder);},unregister:function(responder){this.responders=this.responders.without(responder);},dispatch:function(callback,request,transport,json){this.each(function(responder){if(Object.isFunction(responder[callback])){try{responder[callback].apply(responder,[request,transport,json]);}catch(e){}}});}};Object.extend(Ajax.Responders,Enumerable);Ajax.Responders.register({onCreate:function(){Ajax.activeRequestCount++},onComplete:function(){Ajax.activeRequestCount--}});Ajax.Base=Class.create({initialize:function(options){this.options={method:'post',asynchronous:true,contentType:'application/x-www-form-urlencoded',encoding:'UTF-8',parameters:'',evalJSON:true,evalJS:true};Object.extend(this.options,options||{});this.options.method=this.options.method.toLowerCase();if(Object.isHash(this.options.parameters))
    this.options.parameters=this.options.parameters.toObject();}});Ajax.Request=Class.create(Ajax.Base,{_complete:false,initialize:function($super,url,options){$super(options);this.transport=Ajax.getTransport();this.request(url);},request:function(url){this.url=url;this.method=this.options.method;var params=Object.isString(this.options.parameters)?this.options.parameters:Object.toQueryString(this.options.parameters);if(!['get','post'].include(this.method)){params+=(params?'&':'')+"_method="+this.method;this.method='post';}
    if(params&&this.method==='get'){this.url+=(this.url.include('?')?'&':'?')+params;}
    this.parameters=params.toQueryParams();try{var response=new Ajax.Response(this);if(this.options.onCreate)this.options.onCreate(response);Ajax.Responders.dispatch('onCreate',this,response);this.transport.open(this.method.toUpperCase(),this.url,this.options.asynchronous);if(this.options.asynchronous)this.respondToReadyState.bind(this).defer(1);this.transport.onreadystatechange=this.onStateChange.bind(this);this.setRequestHeaders();this.body=this.method=='post'?(this.options.postBody||params):null;this.transport.send(this.body);if(!this.options.asynchronous&&this.transport.overrideMimeType)
        this.onStateChange();}
    catch(e){this.dispatchException(e);}},onStateChange:function(){var readyState=this.transport.readyState;if(readyState>1&&!((readyState==4)&&this._complete))
    this.respondToReadyState(this.transport.readyState);},setRequestHeaders:function(){var headers={'X-Requested-With':'XMLHttpRequest','X-Prototype-Version':Prototype.Version,'Accept':'text/javascript, text/html, application/xml, text/xml, */*'};if(this.method=='post'){headers['Content-type']=this.options.contentType+
    (this.options.encoding?'; charset='+this.options.encoding:'');if(this.transport.overrideMimeType&&(navigator.userAgent.match(/Gecko\/(\d{4})/)||[0,2005])[1]<2005)
    headers['Connection']='close';}
    if(typeof this.options.requestHeaders=='object'){var extras=this.options.requestHeaders;if(Object.isFunction(extras.push))
        for(var i=0,length=extras.length;i<length;i+=2)
            headers[extras[i]]=extras[i+1];else
        $H(extras).each(function(pair){headers[pair.key]=pair.value});}
    for(var name in headers)
        this.transport.setRequestHeader(name,headers[name]);},success:function(){var status=this.getStatus();return!status||(status>=200&&status<300)||status==304;},getStatus:function(){try{if(this.transport.status===1223)return 204;return this.transport.status||0;}catch(e){return 0}},respondToReadyState:function(readyState){var state=Ajax.Request.Events[readyState],response=new Ajax.Response(this);if(state=='Complete'){try{this._complete=true;(this.options['on'+response.status]||this.options['on'+(this.success()?'Success':'Failure')]||Prototype.emptyFunction)(response,response.headerJSON);}catch(e){this.dispatchException(e);}
    var contentType=response.getHeader('Content-type');if(this.options.evalJS=='force'||(this.options.evalJS&&this.isSameOrigin()&&contentType&&contentType.match(/^\s*(text|application)\/(x-)?(java|ecma)script(;.*)?\s*$/i)))
        this.evalResponse();}
    try{(this.options['on'+state]||Prototype.emptyFunction)(response,response.headerJSON);Ajax.Responders.dispatch('on'+state,this,response,response.headerJSON);}catch(e){this.dispatchException(e);}
    if(state=='Complete'){this.transport.onreadystatechange=Prototype.emptyFunction;}},isSameOrigin:function(){var m=this.url.match(/^\s*https?:\/\/[^\/]*/);return!m||(m[0]=='#{protocol}//#{domain}#{port}'.interpolate({protocol:location.protocol,domain:document.domain,port:location.port?':'+location.port:''}));},getHeader:function(name){try{return this.transport.getResponseHeader(name)||null;}catch(e){return null;}},evalResponse:function(){try{return eval((this.transport.responseText||'').unfilterJSON());}catch(e){this.dispatchException(e);}},dispatchException:function(exception){(this.options.onException||Prototype.emptyFunction)(this,exception);Ajax.Responders.dispatch('onException',this,exception);}});Ajax.Request.Events=['Uninitialized','Loading','Loaded','Interactive','Complete'];Ajax.Response=Class.create({initialize:function(request){this.request=request;var transport=this.transport=request.transport,readyState=this.readyState=transport.readyState;if((readyState>2&&!Prototype.Browser.IE)||readyState==4){this.status=this.getStatus();this.statusText=this.getStatusText();this.responseText=String.interpret(transport.responseText);this.headerJSON=this._getHeaderJSON();}
    if(readyState==4){var xml=transport.responseXML;this.responseXML=Object.isUndefined(xml)?null:xml;this.responseJSON=this._getResponseJSON();}},status:0,statusText:'',getStatus:Ajax.Request.prototype.getStatus,getStatusText:function(){try{return this.transport.statusText||'';}catch(e){return''}},getHeader:Ajax.Request.prototype.getHeader,getAllHeaders:function(){try{return this.getAllResponseHeaders();}catch(e){return null}},getResponseHeader:function(name){return this.transport.getResponseHeader(name);},getAllResponseHeaders:function(){return this.transport.getAllResponseHeaders();},_getHeaderJSON:function(){var json=this.getHeader('X-JSON');if(!json)return null;json=decodeURIComponent(escape(json));try{return json.evalJSON(this.request.options.sanitizeJSON||!this.request.isSameOrigin());}catch(e){this.request.dispatchException(e);}},_getResponseJSON:function(){var options=this.request.options;if(!options.evalJSON||(options.evalJSON!='force'&&!(this.getHeader('Content-type')||'').include('application/json'))||this.responseText.blank())
    return null;try{return this.responseText.evalJSON(options.sanitizeJSON||!this.request.isSameOrigin());}catch(e){this.request.dispatchException(e);}}});Ajax.Updater=Class.create(Ajax.Request,{initialize:function($super,container,url,options){this.container={success:(container.success||container),failure:(container.failure||(container.success?null:container))};options=Object.clone(options);var onComplete=options.onComplete;options.onComplete=(function(response,json){this.updateContent(response.responseText);if(Object.isFunction(onComplete))onComplete(response,json);}).bind(this);$super(url,options);},updateContent:function(responseText){var receiver=this.container[this.success()?'success':'failure'],options=this.options;if(!options.evalScripts)responseText=responseText.stripScripts();if(receiver=$(receiver)){if(options.insertion){if(Object.isString(options.insertion)){var insertion={};insertion[options.insertion]=responseText;receiver.insert(insertion);}
else options.insertion(receiver,responseText);}
else receiver.update(responseText);}}});Ajax.PeriodicalUpdater=Class.create(Ajax.Base,{initialize:function($super,container,url,options){$super(options);this.onComplete=this.options.onComplete;this.frequency=(this.options.frequency||2);this.decay=(this.options.decay||1);this.updater={};this.container=container;this.url=url;this.start();},start:function(){this.options.onComplete=this.updateComplete.bind(this);this.onTimerEvent();},stop:function(){this.updater.options.onComplete=undefined;clearTimeout(this.timer);(this.onComplete||Prototype.emptyFunction).apply(this,arguments);},updateComplete:function(response){if(this.options.decay){this.decay=(response.responseText==this.lastText?this.decay*this.options.decay:1);this.lastText=response.responseText;}
    this.timer=this.onTimerEvent.bind(this).delay(this.decay*this.frequency);},onTimerEvent:function(){this.updater=new Ajax.Updater(this.container,this.url,this.options);}});function $(element){if(arguments.length>1){for(var i=0,elements=[],length=arguments.length;i<length;i++)
    elements.push($(arguments[i]));return elements;}
    if(Object.isString(element))
        element=document.getElementById(element);return Element.extend(element);}
if(Prototype.BrowserFeatures.XPath){document._getElementsByXPath=function(expression,parentElement){var results=[];var query=document.evaluate(expression,$(parentElement)||document,null,XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,null);for(var i=0,length=query.snapshotLength;i<length;i++)
    results.push(Element.extend(query.snapshotItem(i)));return results;};}
if(!Node)var Node={};if(!Node.ELEMENT_NODE){Object.extend(Node,{ELEMENT_NODE:1,ATTRIBUTE_NODE:2,TEXT_NODE:3,CDATA_SECTION_NODE:4,ENTITY_REFERENCE_NODE:5,ENTITY_NODE:6,PROCESSING_INSTRUCTION_NODE:7,COMMENT_NODE:8,DOCUMENT_NODE:9,DOCUMENT_TYPE_NODE:10,DOCUMENT_FRAGMENT_NODE:11,NOTATION_NODE:12});}
(function(global){function shouldUseCache(tagName,attributes){if(tagName==='select')return false;if('type'in attributes)return false;return true;}
    var HAS_EXTENDED_CREATE_ELEMENT_SYNTAX=(function(){try{var el=document.createElement('<input name="x">');return el.tagName.toLowerCase()==='input'&&el.name==='x';}
    catch(err){return false;}})();var element=global.Element;global.Element=function(tagName,attributes){attributes=attributes||{};tagName=tagName.toLowerCase();var cache=Element.cache;if(HAS_EXTENDED_CREATE_ELEMENT_SYNTAX&&attributes.name){tagName='<'+tagName+' name="'+attributes.name+'">';delete attributes.name;return Element.writeAttribute(document.createElement(tagName),attributes);}
        if(!cache[tagName])cache[tagName]=Element.extend(document.createElement(tagName));var node=shouldUseCache(tagName,attributes)?cache[tagName].cloneNode(false):document.createElement(tagName);return Element.writeAttribute(node,attributes);};Object.extend(global.Element,element||{});if(element)global.Element.prototype=element.prototype;})(this);Element.idCounter=1;Element.cache={};Element._purgeElement=function(element){var uid=element._prototypeUID;if(uid){Element.stopObserving(element);element._prototypeUID=void 0;delete Element.Storage[uid];}}
Element.Methods={visible:function(element){return $(element).style.display!='none';},toggle:function(element){element=$(element);Element[Element.visible(element)?'hide':'show'](element);return element;},hide:function(element){element=$(element);element.style.display='none';return element;},show:function(element){element=$(element);element.style.display='';return element;},remove:function(element){element=$(element);element.parentNode.removeChild(element);return element;},update:(function(){var SELECT_ELEMENT_INNERHTML_BUGGY=(function(){var el=document.createElement("select"),isBuggy=true;el.innerHTML="<option value=\"test\">test</option>";if(el.options&&el.options[0]){isBuggy=el.options[0].nodeName.toUpperCase()!=="OPTION";}
    el=null;return isBuggy;})();var TABLE_ELEMENT_INNERHTML_BUGGY=(function(){try{var el=document.createElement("table");if(el&&el.tBodies){el.innerHTML="<tbody><tr><td>test</td></tr></tbody>";var isBuggy=typeof el.tBodies[0]=="undefined";el=null;return isBuggy;}}catch(e){return true;}})();var LINK_ELEMENT_INNERHTML_BUGGY=(function(){try{var el=document.createElement('div');el.innerHTML="<link>";var isBuggy=(el.childNodes.length===0);el=null;return isBuggy;}catch(e){return true;}})();var ANY_INNERHTML_BUGGY=SELECT_ELEMENT_INNERHTML_BUGGY||TABLE_ELEMENT_INNERHTML_BUGGY||LINK_ELEMENT_INNERHTML_BUGGY;var SCRIPT_ELEMENT_REJECTS_TEXTNODE_APPENDING=(function(){var s=document.createElement("script"),isBuggy=false;try{s.appendChild(document.createTextNode(""));isBuggy=!s.firstChild||s.firstChild&&s.firstChild.nodeType!==3;}catch(e){isBuggy=true;}
    s=null;return isBuggy;})();function update(element,content){element=$(element);var purgeElement=Element._purgeElement;var descendants=element.getElementsByTagName('*'),i=descendants.length;while(i--)purgeElement(descendants[i]);if(content&&content.toElement)
    content=content.toElement();if(Object.isElement(content))
    return element.update().insert(content);content=Object.toHTML(content);var tagName=element.tagName.toUpperCase();if(tagName==='SCRIPT'&&SCRIPT_ELEMENT_REJECTS_TEXTNODE_APPENDING){element.text=content;return element;}
    if(ANY_INNERHTML_BUGGY){if(tagName in Element._insertionTranslations.tags){while(element.firstChild){element.removeChild(element.firstChild);}
        Element._getContentFromAnonymousElement(tagName,content.stripScripts()).each(function(node){element.appendChild(node)});}else if(LINK_ELEMENT_INNERHTML_BUGGY&&Object.isString(content)&&content.indexOf('<link')>-1){while(element.firstChild){element.removeChild(element.firstChild);}
        var nodes=Element._getContentFromAnonymousElement(tagName,content.stripScripts(),true);nodes.each(function(node){element.appendChild(node)});}
    else{element.innerHTML=content.stripScripts();}}
    else{element.innerHTML=content.stripScripts();}
    content.evalScripts.bind(content).defer();return element;}
    return update;})(),replace:function(element,content){element=$(element);if(content&&content.toElement)content=content.toElement();else if(!Object.isElement(content)){content=Object.toHTML(content);var range=element.ownerDocument.createRange();range.selectNode(element);content.evalScripts.bind(content).defer();content=range.createContextualFragment(content.stripScripts());}
    element.parentNode.replaceChild(content,element);return element;},insert:function(element,insertions){element=$(element);if(Object.isString(insertions)||Object.isNumber(insertions)||Object.isElement(insertions)||(insertions&&(insertions.toElement||insertions.toHTML)))
    insertions={bottom:insertions};var content,insert,tagName,childNodes;for(var position in insertions){content=insertions[position];position=position.toLowerCase();insert=Element._insertionTranslations[position];if(content&&content.toElement)content=content.toElement();if(Object.isElement(content)){insert(element,content);continue;}
    content=Object.toHTML(content);tagName=((position=='before'||position=='after')?element.parentNode:element).tagName.toUpperCase();childNodes=Element._getContentFromAnonymousElement(tagName,content.stripScripts());if(position=='top'||position=='after')childNodes.reverse();childNodes.each(insert.curry(element));content.evalScripts.bind(content).defer();}
    return element;},wrap:function(element,wrapper,attributes){element=$(element);if(Object.isElement(wrapper))
    $(wrapper).writeAttribute(attributes||{});else if(Object.isString(wrapper))wrapper=new Element(wrapper,attributes);else wrapper=new Element('div',wrapper);if(element.parentNode)
    element.parentNode.replaceChild(wrapper,element);wrapper.appendChild(element);return wrapper;},inspect:function(element){element=$(element);var result='<'+element.tagName.toLowerCase();$H({'id':'id','className':'class'}).each(function(pair){var property=pair.first(),attribute=pair.last(),value=(element[property]||'').toString();if(value)result+=' '+attribute+'='+value.inspect(true);});return result+'>';},recursivelyCollect:function(element,property,maximumLength){element=$(element);maximumLength=maximumLength||-1;var elements=[];while(element=element[property]){if(element.nodeType==1)
    elements.push(Element.extend(element));if(elements.length==maximumLength)
    break;}
    return elements;},ancestors:function(element){return Element.recursivelyCollect(element,'parentNode');},descendants:function(element){return Element.select(element,"*");},firstDescendant:function(element){element=$(element).firstChild;while(element&&element.nodeType!=1)element=element.nextSibling;return $(element);},immediateDescendants:function(element){var results=[],child=$(element).firstChild;while(child){if(child.nodeType===1){results.push(Element.extend(child));}
    child=child.nextSibling;}
    return results;},previousSiblings:function(element,maximumLength){return Element.recursivelyCollect(element,'previousSibling');},nextSiblings:function(element){return Element.recursivelyCollect(element,'nextSibling');},siblings:function(element){element=$(element);return Element.previousSiblings(element).reverse().concat(Element.nextSiblings(element));},match:function(element,selector){element=$(element);if(Object.isString(selector))
    return Prototype.Selector.match(element,selector);return selector.match(element);},up:function(element,expression,index){element=$(element);if(arguments.length==1)return $(element.parentNode);var ancestors=Element.ancestors(element);return Object.isNumber(expression)?ancestors[expression]:Prototype.Selector.find(ancestors,expression,index);},down:function(element,expression,index){element=$(element);if(arguments.length==1)return Element.firstDescendant(element);return Object.isNumber(expression)?Element.descendants(element)[expression]:Element.select(element,expression)[index||0];},previous:function(element,expression,index){element=$(element);if(Object.isNumber(expression))index=expression,expression=false;if(!Object.isNumber(index))index=0;if(expression){return Prototype.Selector.find(element.previousSiblings(),expression,index);}else{return element.recursivelyCollect("previousSibling",index+1)[index];}},next:function(element,expression,index){element=$(element);if(Object.isNumber(expression))index=expression,expression=false;if(!Object.isNumber(index))index=0;if(expression){return Prototype.Selector.find(element.nextSiblings(),expression,index);}else{var maximumLength=Object.isNumber(index)?index+1:1;return element.recursivelyCollect("nextSibling",index+1)[index];}},select:function(element){element=$(element);var expressions=Array.prototype.slice.call(arguments,1).join(', ');return Prototype.Selector.select(expressions,element);},adjacent:function(element){element=$(element);var expressions=Array.prototype.slice.call(arguments,1).join(', ');return Prototype.Selector.select(expressions,element.parentNode).without(element);},identify:function(element){element=$(element);var id=Element.readAttribute(element,'id');if(id)return id;do{id='anonymous_element_'+Element.idCounter++}while($(id));Element.writeAttribute(element,'id',id);return id;},readAttribute:function(element,name){element=$(element);if(Prototype.Browser.IE){var t=Element._attributeTranslations.read;if(t.values[name])return t.values[name](element,name);if(t.names[name])name=t.names[name];if(name.include(':')){return(!element.attributes||!element.attributes[name])?null:element.attributes[name].value;}}
    return element.getAttribute(name);},writeAttribute:function(element,name,value){element=$(element);var attributes={},t=Element._attributeTranslations.write;if(typeof name=='object')attributes=name;else attributes[name]=Object.isUndefined(value)?true:value;for(var attr in attributes){name=t.names[attr]||attr;value=attributes[attr];if(t.values[attr])name=t.values[attr](element,value);if(value===false||value===null)
    element.removeAttribute(name);else if(value===true)
    element.setAttribute(name,name);else element.setAttribute(name,value);}
    return element;},getHeight:function(element){return Element.getDimensions(element).height;},getWidth:function(element){return Element.getDimensions(element).width;},classNames:function(element){return new Element.ClassNames(element);},hasClassName:function(element,className){if(!(element=$(element)))return;var elementClassName=element.className;return(elementClassName.length>0&&(elementClassName==className||new RegExp("(^|\\s)"+className+"(\\s|$)").test(elementClassName)));},addClassName:function(element,className){if(!(element=$(element)))return;if(!Element.hasClassName(element,className))
    element.className+=(element.className?' ':'')+className;return element;},removeClassName:function(element,className){if(!(element=$(element)))return;element.className=element.className.replace(new RegExp("(^|\\s+)"+className+"(\\s+|$)"),' ').strip();return element;},toggleClassName:function(element,className){if(!(element=$(element)))return;return Element[Element.hasClassName(element,className)?'removeClassName':'addClassName'](element,className);},cleanWhitespace:function(element){element=$(element);var node=element.firstChild;while(node){var nextNode=node.nextSibling;if(node.nodeType==3&&!/\S/.test(node.nodeValue))
    element.removeChild(node);node=nextNode;}
    return element;},empty:function(element){return $(element).innerHTML.blank();},descendantOf:function(element,ancestor){element=$(element),ancestor=$(ancestor);if(element.compareDocumentPosition)
    return(element.compareDocumentPosition(ancestor)&8)===8;if(ancestor.contains)
    return ancestor.contains(element)&&ancestor!==element;while(element=element.parentNode)
    if(element==ancestor)return true;return false;},scrollTo:function(element){element=$(element);var pos=Element.cumulativeOffset(element);window.scrollTo(pos[0],pos[1]);return element;},getStyle:function(element,style){element=$(element);style=style=='float'?'cssFloat':style.camelize();var value=element.style[style];if(!value||value=='auto'){var css=document.defaultView.getComputedStyle(element,null);value=css?css[style]:null;}
    if(style=='opacity')return value?parseFloat(value):1.0;return value=='auto'?null:value;},getOpacity:function(element){return $(element).getStyle('opacity');},setStyle:function(element,styles){element=$(element);var elementStyle=element.style,match;if(Object.isString(styles)){element.style.cssText+=';'+styles;return styles.include('opacity')?element.setOpacity(styles.match(/opacity:\s*(\d?\.?\d*)/)[1]):element;}
    for(var property in styles)
        if(property=='opacity')element.setOpacity(styles[property]);else
            elementStyle[(property=='float'||property=='cssFloat')?(Object.isUndefined(elementStyle.styleFloat)?'cssFloat':'styleFloat'):property]=styles[property];return element;},setOpacity:function(element,value){element=$(element);element.style.opacity=(value==1||value==='')?'':(value<0.00001)?0:value;return element;},makePositioned:function(element){element=$(element);var pos=Element.getStyle(element,'position');if(pos=='static'||!pos){element._madePositioned=true;element.style.position='relative';if(Prototype.Browser.Opera){element.style.top=0;element.style.left=0;}}
    return element;},undoPositioned:function(element){element=$(element);if(element._madePositioned){element._madePositioned=undefined;element.style.position=element.style.top=element.style.left=element.style.bottom=element.style.right='';}
    return element;},makeClipping:function(element){element=$(element);if(element._overflow)return element;element._overflow=Element.getStyle(element,'overflow')||'auto';if(element._overflow!=='hidden')
    element.style.overflow='hidden';return element;},undoClipping:function(element){element=$(element);if(!element._overflow)return element;element.style.overflow=element._overflow=='auto'?'':element._overflow;element._overflow=null;return element;},clonePosition:function(element,source){var options=Object.extend({setLeft:true,setTop:true,setWidth:true,setHeight:true,offsetTop:0,offsetLeft:0},arguments[2]||{});source=$(source);var p=Element.viewportOffset(source),delta=[0,0],parent=null;element=$(element);if(Element.getStyle(element,'position')=='absolute'){parent=Element.getOffsetParent(element);delta=Element.viewportOffset(parent);}
    if(parent==document.body){delta[0]-=document.body.offsetLeft;delta[1]-=document.body.offsetTop;}
    if(options.setLeft)element.style.left=(p[0]-delta[0]+options.offsetLeft)+'px';if(options.setTop)element.style.top=(p[1]-delta[1]+options.offsetTop)+'px';if(options.setWidth)element.style.width=source.offsetWidth+'px';if(options.setHeight)element.style.height=source.offsetHeight+'px';return element;}};Object.extend(Element.Methods,{getElementsBySelector:Element.Methods.select,childElements:Element.Methods.immediateDescendants});Element._attributeTranslations={write:{names:{className:'class',htmlFor:'for'},values:{}}};if(Prototype.Browser.Opera){Element.Methods.getStyle=Element.Methods.getStyle.wrap(function(proceed,element,style){switch(style){case'height':case'width':if(!Element.visible(element))return null;var dim=parseInt(proceed(element,style),10);if(dim!==element['offset'+style.capitalize()])
    return dim+'px';var properties;if(style==='height'){properties=['border-top-width','padding-top','padding-bottom','border-bottom-width'];}
else{properties=['border-left-width','padding-left','padding-right','border-right-width'];}
    return properties.inject(dim,function(memo,property){var val=proceed(element,property);return val===null?memo:memo-parseInt(val,10);})+'px';default:return proceed(element,style);}});Element.Methods.readAttribute=Element.Methods.readAttribute.wrap(function(proceed,element,attribute){if(attribute==='title')return element.title;return proceed(element,attribute);});}
else if(Prototype.Browser.IE){Element.Methods.getStyle=function(element,style){element=$(element);style=(style=='float'||style=='cssFloat')?'styleFloat':style.camelize();var value=element.style[style];if(!value&&element.currentStyle)value=element.currentStyle[style];if(style=='opacity'){if(value=(element.getStyle('filter')||'').match(/alpha\(opacity=(.*)\)/))
    if(value[1])return parseFloat(value[1])/100;return 1.0;}
    if(value=='auto'){if((style=='width'||style=='height')&&(element.getStyle('display')!='none'))
        return element['offset'+style.capitalize()]+'px';return null;}
    return value;};Element.Methods.setOpacity=function(element,value){function stripAlpha(filter){return filter.replace(/alpha\([^\)]*\)/gi,'');}
    element=$(element);var currentStyle=element.currentStyle;if((currentStyle&&!currentStyle.hasLayout)||(!currentStyle&&element.style.zoom=='normal'))
        element.style.zoom=1;var filter=element.getStyle('filter'),style=element.style;if(value==1||value===''){(filter=stripAlpha(filter))?style.filter=filter:style.removeAttribute('filter');return element;}else if(value<0.00001)value=0;style.filter=stripAlpha(filter)+'alpha(opacity='+(value*100)+')';return element;};Element._attributeTranslations=(function(){var classProp='className',forProp='for',el=document.createElement('div');el.setAttribute(classProp,'x');if(el.className!=='x'){el.setAttribute('class','x');if(el.className==='x'){classProp='class';}}
    el=null;el=document.createElement('label');el.setAttribute(forProp,'x');if(el.htmlFor!=='x'){el.setAttribute('htmlFor','x');if(el.htmlFor==='x'){forProp='htmlFor';}}
    el=null;return{read:{names:{'class':classProp,'className':classProp,'for':forProp,'htmlFor':forProp},values:{_getAttr:function(element,attribute){return element.getAttribute(attribute);},_getAttr2:function(element,attribute){return element.getAttribute(attribute,2);},_getAttrNode:function(element,attribute){var node=element.getAttributeNode(attribute);return node?node.value:"";},_getEv:(function(){var el=document.createElement('div'),f;el.onclick=Prototype.emptyFunction;var value=el.getAttribute('onclick');if(String(value).indexOf('{')>-1){f=function(element,attribute){attribute=element.getAttribute(attribute);if(!attribute)return null;attribute=attribute.toString();attribute=attribute.split('{')[1];attribute=attribute.split('}')[0];return attribute.strip();};}
    else if(value===''){f=function(element,attribute){attribute=element.getAttribute(attribute);if(!attribute)return null;return attribute.strip();};}
        el=null;return f;})(),_flag:function(element,attribute){return $(element).hasAttribute(attribute)?attribute:null;},style:function(element){return element.style.cssText.toLowerCase();},title:function(element){return element.title;}}}}})();Element._attributeTranslations.write={names:Object.extend({cellpadding:'cellPadding',cellspacing:'cellSpacing'},Element._attributeTranslations.read.names),values:{checked:function(element,value){element.checked=!!value;},style:function(element,value){element.style.cssText=value?value:'';}}};Element._attributeTranslations.has={};$w('colSpan rowSpan vAlign dateTime accessKey tabIndex '+'encType maxLength readOnly longDesc frameBorder').each(function(attr){Element._attributeTranslations.write.names[attr.toLowerCase()]=attr;Element._attributeTranslations.has[attr.toLowerCase()]=attr;});(function(v){Object.extend(v,{href:v._getAttr2,src:v._getAttr2,type:v._getAttr,action:v._getAttrNode,disabled:v._flag,checked:v._flag,readonly:v._flag,multiple:v._flag,onload:v._getEv,onunload:v._getEv,onclick:v._getEv,ondblclick:v._getEv,onmousedown:v._getEv,onmouseup:v._getEv,onmouseover:v._getEv,onmousemove:v._getEv,onmouseout:v._getEv,onfocus:v._getEv,onblur:v._getEv,onkeypress:v._getEv,onkeydown:v._getEv,onkeyup:v._getEv,onsubmit:v._getEv,onreset:v._getEv,onselect:v._getEv,onchange:v._getEv});})(Element._attributeTranslations.read.values);if(Prototype.BrowserFeatures.ElementExtensions){(function(){function _descendants(element){var nodes=element.getElementsByTagName('*'),results=[];for(var i=0,node;node=nodes[i];i++)
    if(node.tagName!=="!")
        results.push(node);return results;}
    Element.Methods.down=function(element,expression,index){element=$(element);if(arguments.length==1)return element.firstDescendant();return Object.isNumber(expression)?_descendants(element)[expression]:Element.select(element,expression)[index||0];}})();}}
else if(Prototype.Browser.Gecko&&/rv:1\.8\.0/.test(navigator.userAgent)){Element.Methods.setOpacity=function(element,value){element=$(element);element.style.opacity=(value==1)?0.999999:(value==='')?'':(value<0.00001)?0:value;return element;};}
else if(Prototype.Browser.WebKit){Element.Methods.setOpacity=function(element,value){element=$(element);element.style.opacity=(value==1||value==='')?'':(value<0.00001)?0:value;if(value==1)
    if(element.tagName.toUpperCase()=='IMG'&&element.width){element.width++;element.width--;}else try{var n=document.createTextNode(' ');element.appendChild(n);element.removeChild(n);}catch(e){}
    return element;};}
if('outerHTML'in document.documentElement){Element.Methods.replace=function(element,content){element=$(element);if(content&&content.toElement)content=content.toElement();if(Object.isElement(content)){element.parentNode.replaceChild(content,element);return element;}
    content=Object.toHTML(content);var parent=element.parentNode,tagName=parent.tagName.toUpperCase();if(Element._insertionTranslations.tags[tagName]){var nextSibling=element.next(),fragments=Element._getContentFromAnonymousElement(tagName,content.stripScripts());parent.removeChild(element);if(nextSibling)
        fragments.each(function(node){parent.insertBefore(node,nextSibling)});else
        fragments.each(function(node){parent.appendChild(node)});}
    else element.outerHTML=content.stripScripts();content.evalScripts.bind(content).defer();return element;};}
Element._returnOffset=function(l,t){var result=[l,t];result.left=l;result.top=t;return result;};Element._getContentFromAnonymousElement=function(tagName,html,force){var div=new Element('div'),t=Element._insertionTranslations.tags[tagName];var workaround=false;if(t)workaround=true;else if(force){workaround=true;t=['','',0];}
    if(workaround){div.innerHTML='&nbsp;'+t[0]+html+t[1];div.removeChild(div.firstChild);for(var i=t[2];i--;){div=div.firstChild;}}
    else{div.innerHTML=html;}
    return $A(div.childNodes);};Element._insertionTranslations={before:function(element,node){element.parentNode.insertBefore(node,element);},top:function(element,node){element.insertBefore(node,element.firstChild);},bottom:function(element,node){element.appendChild(node);},after:function(element,node){element.parentNode.insertBefore(node,element.nextSibling);},tags:{TABLE:['<table>','</table>',1],TBODY:['<table><tbody>','</tbody></table>',2],TR:['<table><tbody><tr>','</tr></tbody></table>',3],TD:['<table><tbody><tr><td>','</td></tr></tbody></table>',4],SELECT:['<select>','</select>',1]}};(function(){var tags=Element._insertionTranslations.tags;Object.extend(tags,{THEAD:tags.TBODY,TFOOT:tags.TBODY,TH:tags.TD});})();Element.Methods.Simulated={hasAttribute:function(element,attribute){attribute=Element._attributeTranslations.has[attribute]||attribute;var node=$(element).getAttributeNode(attribute);return!!(node&&node.specified);}};Element.Methods.ByTag={};Object.extend(Element,Element.Methods);(function(div){if(!Prototype.BrowserFeatures.ElementExtensions&&div['__proto__']){window.HTMLElement={};window.HTMLElement.prototype=div['__proto__'];Prototype.BrowserFeatures.ElementExtensions=true;}
    div=null;})(document.createElement('div'));Element.extend=(function(){function checkDeficiency(tagName){if(typeof window.Element!='undefined'){var proto=window.Element.prototype;if(proto){var id='_'+(Math.random()+'').slice(2),el=document.createElement(tagName);proto[id]='x';var isBuggy=(el[id]!=='x');delete proto[id];el=null;return isBuggy;}}
    return false;}
    function extendElementWith(element,methods){for(var property in methods){var value=methods[property];if(Object.isFunction(value)&&!(property in element))
        element[property]=value.methodize();}}
    var HTMLOBJECTELEMENT_PROTOTYPE_BUGGY=checkDeficiency('object');if(Prototype.BrowserFeatures.SpecificElementExtensions){if(HTMLOBJECTELEMENT_PROTOTYPE_BUGGY){return function(element){if(element&&typeof element._extendedByPrototype=='undefined'){var t=element.tagName;if(t&&(/^(?:object|applet|embed)$/i.test(t))){extendElementWith(element,Element.Methods);extendElementWith(element,Element.Methods.Simulated);extendElementWith(element,Element.Methods.ByTag[t.toUpperCase()]);}}
        return element;}}
        return Prototype.K;}
    var Methods={},ByTag=Element.Methods.ByTag;var extend=Object.extend(function(element){if(!element||typeof element._extendedByPrototype!='undefined'||element.nodeType!=1||element==window)return element;var methods=Object.clone(Methods),tagName=element.tagName.toUpperCase();if(ByTag[tagName])Object.extend(methods,ByTag[tagName]);extendElementWith(element,methods);element._extendedByPrototype=Prototype.emptyFunction;return element;},{refresh:function(){if(!Prototype.BrowserFeatures.ElementExtensions){Object.extend(Methods,Element.Methods);Object.extend(Methods,Element.Methods.Simulated);}}});extend.refresh();return extend;})();if(document.documentElement.hasAttribute){Element.hasAttribute=function(element,attribute){return element.hasAttribute(attribute);};}
else{Element.hasAttribute=Element.Methods.Simulated.hasAttribute;}
Element.addMethods=function(methods){var F=Prototype.BrowserFeatures,T=Element.Methods.ByTag;if(!methods){Object.extend(Form,Form.Methods);Object.extend(Form.Element,Form.Element.Methods);Object.extend(Element.Methods.ByTag,{"FORM":Object.clone(Form.Methods),"INPUT":Object.clone(Form.Element.Methods),"SELECT":Object.clone(Form.Element.Methods),"TEXTAREA":Object.clone(Form.Element.Methods),"BUTTON":Object.clone(Form.Element.Methods)});}
    if(arguments.length==2){var tagName=methods;methods=arguments[1];}
    if(!tagName)Object.extend(Element.Methods,methods||{});else{if(Object.isArray(tagName))tagName.each(extend);else extend(tagName);}
    function extend(tagName){tagName=tagName.toUpperCase();if(!Element.Methods.ByTag[tagName])
        Element.Methods.ByTag[tagName]={};Object.extend(Element.Methods.ByTag[tagName],methods);}
    function copy(methods,destination,onlyIfAbsent){onlyIfAbsent=onlyIfAbsent||false;for(var property in methods){var value=methods[property];if(!Object.isFunction(value))continue;if(!onlyIfAbsent||!(property in destination))
        destination[property]=value.methodize();}}
    function findDOMClass(tagName){var klass;var trans={"OPTGROUP":"OptGroup","TEXTAREA":"TextArea","P":"Paragraph","FIELDSET":"FieldSet","UL":"UList","OL":"OList","DL":"DList","DIR":"Directory","H1":"Heading","H2":"Heading","H3":"Heading","H4":"Heading","H5":"Heading","H6":"Heading","Q":"Quote","INS":"Mod","DEL":"Mod","A":"Anchor","IMG":"Image","CAPTION":"TableCaption","COL":"TableCol","COLGROUP":"TableCol","THEAD":"TableSection","TFOOT":"TableSection","TBODY":"TableSection","TR":"TableRow","TH":"TableCell","TD":"TableCell","FRAMESET":"FrameSet","IFRAME":"IFrame"};if(trans[tagName])klass='HTML'+trans[tagName]+'Element';if(window[klass])return window[klass];klass='HTML'+tagName+'Element';if(window[klass])return window[klass];klass='HTML'+tagName.capitalize()+'Element';if(window[klass])return window[klass];var element=document.createElement(tagName),proto=element['__proto__']||element.constructor.prototype;element=null;return proto;}
    var elementPrototype=window.HTMLElement?HTMLElement.prototype:Element.prototype;if(F.ElementExtensions){copy(Element.Methods,elementPrototype);copy(Element.Methods.Simulated,elementPrototype,true);}
    if(F.SpecificElementExtensions){for(var tag in Element.Methods.ByTag){var klass=findDOMClass(tag);if(Object.isUndefined(klass))continue;copy(T[tag],klass.prototype);}}
    Object.extend(Element,Element.Methods);delete Element.ByTag;if(Element.extend.refresh)Element.extend.refresh();Element.cache={};};document.viewport={getDimensions:function(){return{width:this.getWidth(),height:this.getHeight()};},getScrollOffsets:function(){return Element._returnOffset(window.pageXOffset||document.documentElement.scrollLeft||document.body.scrollLeft,window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop);}};(function(viewport){var B=Prototype.Browser,doc=document,element,property={};function getRootElement(){if(B.WebKit&&!doc.evaluate)
    return document;if(B.Opera&&window.parseFloat(window.opera.version())<9.5)
    return document.body;return document.documentElement;}
    function define(D){if(!element)element=getRootElement();property[D]='client'+D;viewport['get'+D]=function(){return element[property[D]]};return viewport['get'+D]();}
    viewport.getWidth=define.curry('Width');viewport.getHeight=define.curry('Height');})(document.viewport);Element.Storage={UID:1};Element.addMethods({getStorage:function(element){if(!(element=$(element)))return;var uid;if(element===window){uid=0;}else{if(typeof element._prototypeUID==="undefined")
    element._prototypeUID=Element.Storage.UID++;uid=element._prototypeUID;}
    if(!Element.Storage[uid])
        Element.Storage[uid]=$H();return Element.Storage[uid];},store:function(element,key,value){if(!(element=$(element)))return;if(arguments.length===2){Element.getStorage(element).update(key);}else{Element.getStorage(element).set(key,value);}
    return element;},retrieve:function(element,key,defaultValue){if(!(element=$(element)))return;var hash=Element.getStorage(element),value=hash.get(key);if(Object.isUndefined(value)){hash.set(key,defaultValue);value=defaultValue;}
    return value;},clone:function(element,deep){if(!(element=$(element)))return;var clone=element.cloneNode(deep);clone._prototypeUID=void 0;if(deep){var descendants=Element.select(clone,'*'),i=descendants.length;while(i--){descendants[i]._prototypeUID=void 0;}}
    return Element.extend(clone);},purge:function(element){if(!(element=$(element)))return;var purgeElement=Element._purgeElement;purgeElement(element);var descendants=element.getElementsByTagName('*'),i=descendants.length;while(i--)purgeElement(descendants[i]);return null;}});(function(){function toDecimal(pctString){var match=pctString.match(/^(\d+)%?$/i);if(!match)return null;return(Number(match[1])/100);}
    function getPixelValue(value,property,context){var element=null;if(Object.isElement(value)){element=value;value=element.getStyle(property);}
        if(value===null){return null;}
        if((/^(?:-)?\d+(\.\d+)?(px)?$/i).test(value)){return window.parseFloat(value);}
        var isPercentage=value.include('%'),isViewport=(context===document.viewport);if(/\d/.test(value)&&element&&element.runtimeStyle&&!(isPercentage&&isViewport)){var style=element.style.left,rStyle=element.runtimeStyle.left;element.runtimeStyle.left=element.currentStyle.left;element.style.left=value||0;value=element.style.pixelLeft;element.style.left=style;element.runtimeStyle.left=rStyle;return value;}
        if(element&&isPercentage){context=context||element.parentNode;var decimal=toDecimal(value);var whole=null;var position=element.getStyle('position');var isHorizontal=property.include('left')||property.include('right')||property.include('width');var isVertical=property.include('top')||property.include('bottom')||property.include('height');if(context===document.viewport){if(isHorizontal){whole=document.viewport.getWidth();}else if(isVertical){whole=document.viewport.getHeight();}}else{if(isHorizontal){whole=$(context).measure('width');}else if(isVertical){whole=$(context).measure('height');}}
            return(whole===null)?0:whole*decimal;}
        return 0;}
    function toCSSPixels(number){if(Object.isString(number)&&number.endsWith('px')){return number;}
        return number+'px';}
    function isDisplayed(element){var originalElement=element;while(element&&element.parentNode){var display=element.getStyle('display');if(display==='none'){return false;}
        element=$(element.parentNode);}
        return true;}
    var hasLayout=Prototype.K;if('currentStyle'in document.documentElement){hasLayout=function(element){if(!element.currentStyle.hasLayout){element.style.zoom=1;}
        return element;};}
    function cssNameFor(key){if(key.include('border'))key=key+'-width';return key.camelize();}
    Element.Layout=Class.create(Hash,{initialize:function($super,element,preCompute){$super();this.element=$(element);Element.Layout.PROPERTIES.each(function(property){this._set(property,null);},this);if(preCompute){this._preComputing=true;this._begin();Element.Layout.PROPERTIES.each(this._compute,this);this._end();this._preComputing=false;}},_set:function(property,value){return Hash.prototype.set.call(this,property,value);},set:function(property,value){throw"Properties of Element.Layout are read-only.";},get:function($super,property){var value=$super(property);return value===null?this._compute(property):value;},_begin:function(){if(this._prepared)return;var element=this.element;if(isDisplayed(element)){this._prepared=true;return;}
        var originalStyles={position:element.style.position||'',width:element.style.width||'',visibility:element.style.visibility||'',display:element.style.display||''};element.store('prototype_original_styles',originalStyles);var position=element.getStyle('position'),width=element.getStyle('width');if(width==="0px"||width===null){element.style.display='block';width=element.getStyle('width');}
        var context=(position==='fixed')?document.viewport:element.parentNode;element.setStyle({position:'absolute',visibility:'hidden',display:'block'});var positionedWidth=element.getStyle('width');var newWidth;if(width&&(positionedWidth===width)){newWidth=getPixelValue(element,'width',context);}else if(position==='absolute'||position==='fixed'){newWidth=getPixelValue(element,'width',context);}else{var parent=element.parentNode,pLayout=$(parent).getLayout();newWidth=pLayout.get('width')-
            this.get('margin-left')-
            this.get('border-left')-
            this.get('padding-left')-
            this.get('padding-right')-
            this.get('border-right')-
            this.get('margin-right');}
        element.setStyle({width:newWidth+'px'});this._prepared=true;},_end:function(){var element=this.element;var originalStyles=element.retrieve('prototype_original_styles');element.store('prototype_original_styles',null);element.setStyle(originalStyles);this._prepared=false;},_compute:function(property){var COMPUTATIONS=Element.Layout.COMPUTATIONS;if(!(property in COMPUTATIONS)){throw"Property not found.";}
        return this._set(property,COMPUTATIONS[property].call(this,this.element));},toObject:function(){var args=$A(arguments);var keys=(args.length===0)?Element.Layout.PROPERTIES:args.join(' ').split(' ');var obj={};keys.each(function(key){if(!Element.Layout.PROPERTIES.include(key))return;var value=this.get(key);if(value!=null)obj[key]=value;},this);return obj;},toHash:function(){var obj=this.toObject.apply(this,arguments);return new Hash(obj);},toCSS:function(){var args=$A(arguments);var keys=(args.length===0)?Element.Layout.PROPERTIES:args.join(' ').split(' ');var css={};keys.each(function(key){if(!Element.Layout.PROPERTIES.include(key))return;if(Element.Layout.COMPOSITE_PROPERTIES.include(key))return;var value=this.get(key);if(value!=null)css[cssNameFor(key)]=value+'px';},this);return css;},inspect:function(){return"#<Element.Layout>";}});Object.extend(Element.Layout,{PROPERTIES:$w('height width top left right bottom border-left border-right border-top border-bottom padding-left padding-right padding-top padding-bottom margin-top margin-bottom margin-left margin-right padding-box-width padding-box-height border-box-width border-box-height margin-box-width margin-box-height'),COMPOSITE_PROPERTIES:$w('padding-box-width padding-box-height margin-box-width margin-box-height border-box-width border-box-height'),COMPUTATIONS:{'height':function(element){if(!this._preComputing)this._begin();var bHeight=this.get('border-box-height');if(bHeight<=0){if(!this._preComputing)this._end();return 0;}
        var bTop=this.get('border-top'),bBottom=this.get('border-bottom');var pTop=this.get('padding-top'),pBottom=this.get('padding-bottom');if(!this._preComputing)this._end();return bHeight-bTop-bBottom-pTop-pBottom;},'width':function(element){if(!this._preComputing)this._begin();var bWidth=this.get('border-box-width');if(bWidth<=0){if(!this._preComputing)this._end();return 0;}
        var bLeft=this.get('border-left'),bRight=this.get('border-right');var pLeft=this.get('padding-left'),pRight=this.get('padding-right');if(!this._preComputing)this._end();return bWidth-bLeft-bRight-pLeft-pRight;},'padding-box-height':function(element){var height=this.get('height'),pTop=this.get('padding-top'),pBottom=this.get('padding-bottom');return height+pTop+pBottom;},'padding-box-width':function(element){var width=this.get('width'),pLeft=this.get('padding-left'),pRight=this.get('padding-right');return width+pLeft+pRight;},'border-box-height':function(element){if(!this._preComputing)this._begin();var height=element.offsetHeight;if(!this._preComputing)this._end();return height;},'border-box-width':function(element){if(!this._preComputing)this._begin();var width=element.offsetWidth;if(!this._preComputing)this._end();return width;},'margin-box-height':function(element){var bHeight=this.get('border-box-height'),mTop=this.get('margin-top'),mBottom=this.get('margin-bottom');if(bHeight<=0)return 0;return bHeight+mTop+mBottom;},'margin-box-width':function(element){var bWidth=this.get('border-box-width'),mLeft=this.get('margin-left'),mRight=this.get('margin-right');if(bWidth<=0)return 0;return bWidth+mLeft+mRight;},'top':function(element){var offset=element.positionedOffset();return offset.top;},'bottom':function(element){var offset=element.positionedOffset(),parent=element.getOffsetParent(),pHeight=parent.measure('height');var mHeight=this.get('border-box-height');return pHeight-mHeight-offset.top;},'left':function(element){var offset=element.positionedOffset();return offset.left;},'right':function(element){var offset=element.positionedOffset(),parent=element.getOffsetParent(),pWidth=parent.measure('width');var mWidth=this.get('border-box-width');return pWidth-mWidth-offset.left;},'padding-top':function(element){return getPixelValue(element,'paddingTop');},'padding-bottom':function(element){return getPixelValue(element,'paddingBottom');},'padding-left':function(element){return getPixelValue(element,'paddingLeft');},'padding-right':function(element){return getPixelValue(element,'paddingRight');},'border-top':function(element){return getPixelValue(element,'borderTopWidth');},'border-bottom':function(element){return getPixelValue(element,'borderBottomWidth');},'border-left':function(element){return getPixelValue(element,'borderLeftWidth');},'border-right':function(element){return getPixelValue(element,'borderRightWidth');},'margin-top':function(element){return getPixelValue(element,'marginTop');},'margin-bottom':function(element){return getPixelValue(element,'marginBottom');},'margin-left':function(element){return getPixelValue(element,'marginLeft');},'margin-right':function(element){return getPixelValue(element,'marginRight');}}});if('getBoundingClientRect'in document.documentElement){Object.extend(Element.Layout.COMPUTATIONS,{'right':function(element){var parent=hasLayout(element.getOffsetParent());var rect=element.getBoundingClientRect(),pRect=parent.getBoundingClientRect();return(pRect.right-rect.right).round();},'bottom':function(element){var parent=hasLayout(element.getOffsetParent());var rect=element.getBoundingClientRect(),pRect=parent.getBoundingClientRect();return(pRect.bottom-rect.bottom).round();}});}
    Element.Offset=Class.create({initialize:function(left,top){this.left=left.round();this.top=top.round();this[0]=this.left;this[1]=this.top;},relativeTo:function(offset){return new Element.Offset(this.left-offset.left,this.top-offset.top);},inspect:function(){return"#<Element.Offset left: #{left} top: #{top}>".interpolate(this);},toString:function(){return"[#{left}, #{top}]".interpolate(this);},toArray:function(){return[this.left,this.top];}});function getLayout(element,preCompute){return new Element.Layout(element,preCompute);}
    function measure(element,property){return $(element).getLayout().get(property);}
    function getDimensions(element){element=$(element);var display=Element.getStyle(element,'display');if(display&&display!=='none'){return{width:element.offsetWidth,height:element.offsetHeight};}
        var style=element.style;var originalStyles={visibility:style.visibility,position:style.position,display:style.display};var newStyles={visibility:'hidden',display:'block'};if(originalStyles.position!=='fixed')
            newStyles.position='absolute';Element.setStyle(element,newStyles);var dimensions={width:element.offsetWidth,height:element.offsetHeight};Element.setStyle(element,originalStyles);return dimensions;}
    function getOffsetParent(element){element=$(element);if(isDocument(element)||isDetached(element)||isBody(element)||isHtml(element))
        return $(document.body);var isInline=(Element.getStyle(element,'display')==='inline');if(!isInline&&element.offsetParent)return $(element.offsetParent);while((element=element.parentNode)&&element!==document.body){if(Element.getStyle(element,'position')!=='static'){return isHtml(element)?$(document.body):$(element);}}
        return $(document.body);}
    function cumulativeOffset(element){element=$(element);var valueT=0,valueL=0;if(element.parentNode){do{valueT+=element.offsetTop||0;valueL+=element.offsetLeft||0;element=element.offsetParent;}while(element);}
        return new Element.Offset(valueL,valueT);}
    function positionedOffset(element){element=$(element);var layout=element.getLayout();var valueT=0,valueL=0;do{valueT+=element.offsetTop||0;valueL+=element.offsetLeft||0;element=element.offsetParent;if(element){if(isBody(element))break;var p=Element.getStyle(element,'position');if(p!=='static')break;}}while(element);valueL-=layout.get('margin-top');valueT-=layout.get('margin-left');return new Element.Offset(valueL,valueT);}
    function cumulativeScrollOffset(element){var valueT=0,valueL=0;do{valueT+=element.scrollTop||0;valueL+=element.scrollLeft||0;element=element.parentNode;}while(element);return new Element.Offset(valueL,valueT);}
    function viewportOffset(forElement){element=$(element);var valueT=0,valueL=0,docBody=document.body;var element=forElement;do{valueT+=element.offsetTop||0;valueL+=element.offsetLeft||0;if(element.offsetParent==docBody&&Element.getStyle(element,'position')=='absolute')break;}while(element=element.offsetParent);element=forElement;do{if(element!=docBody){valueT-=element.scrollTop||0;valueL-=element.scrollLeft||0;}}while(element=element.parentNode);return new Element.Offset(valueL,valueT);}
    function absolutize(element){element=$(element);if(Element.getStyle(element,'position')==='absolute'){return element;}
        var offsetParent=getOffsetParent(element);var eOffset=element.viewportOffset(),pOffset=offsetParent.viewportOffset();var offset=eOffset.relativeTo(pOffset);var layout=element.getLayout();element.store('prototype_absolutize_original_styles',{left:element.getStyle('left'),top:element.getStyle('top'),width:element.getStyle('width'),height:element.getStyle('height')});element.setStyle({position:'absolute',top:offset.top+'px',left:offset.left+'px',width:layout.get('width')+'px',height:layout.get('height')+'px'});return element;}
    function relativize(element){element=$(element);if(Element.getStyle(element,'position')==='relative'){return element;}
        var originalStyles=element.retrieve('prototype_absolutize_original_styles');if(originalStyles)element.setStyle(originalStyles);return element;}
    if(Prototype.Browser.IE){getOffsetParent=getOffsetParent.wrap(function(proceed,element){element=$(element);if(isDocument(element)||isDetached(element)||isBody(element)||isHtml(element))
        return $(document.body);var position=element.getStyle('position');if(position!=='static')return proceed(element);element.setStyle({position:'relative'});var value=proceed(element);element.setStyle({position:position});return value;});positionedOffset=positionedOffset.wrap(function(proceed,element){element=$(element);if(!element.parentNode)return new Element.Offset(0,0);var position=element.getStyle('position');if(position!=='static')return proceed(element);var offsetParent=element.getOffsetParent();if(offsetParent&&offsetParent.getStyle('position')==='fixed')
        hasLayout(offsetParent);element.setStyle({position:'relative'});var value=proceed(element);element.setStyle({position:position});return value;});}else if(Prototype.Browser.Webkit){cumulativeOffset=function(element){element=$(element);var valueT=0,valueL=0;do{valueT+=element.offsetTop||0;valueL+=element.offsetLeft||0;if(element.offsetParent==document.body)
        if(Element.getStyle(element,'position')=='absolute')break;element=element.offsetParent;}while(element);return new Element.Offset(valueL,valueT);};}
    Element.addMethods({getLayout:getLayout,measure:measure,getDimensions:getDimensions,getOffsetParent:getOffsetParent,cumulativeOffset:cumulativeOffset,positionedOffset:positionedOffset,cumulativeScrollOffset:cumulativeScrollOffset,viewportOffset:viewportOffset,absolutize:absolutize,relativize:relativize});function isBody(element){return element.nodeName.toUpperCase()==='BODY';}
    function isHtml(element){return element.nodeName.toUpperCase()==='HTML';}
    function isDocument(element){return element.nodeType===Node.DOCUMENT_NODE;}
    function isDetached(element){return element!==document.body&&!Element.descendantOf(element,document.body);}
    if('getBoundingClientRect'in document.documentElement){Element.addMethods({viewportOffset:function(element){element=$(element);if(isDetached(element))return new Element.Offset(0,0);var rect=element.getBoundingClientRect(),docEl=document.documentElement;return new Element.Offset(rect.left-docEl.clientLeft,rect.top-docEl.clientTop);}});}})();window.$$=function(){var expression=$A(arguments).join(', ');return Prototype.Selector.select(expression,document);};Prototype.Selector=(function(){function select(){throw new Error('Method "Prototype.Selector.select" must be defined.');}
    function match(){throw new Error('Method "Prototype.Selector.match" must be defined.');}
    function find(elements,expression,index){index=index||0;var match=Prototype.Selector.match,length=elements.length,matchIndex=0,i;for(i=0;i<length;i++){if(match(elements[i],expression)&&index==matchIndex++){return Element.extend(elements[i]);}}}
    function extendElements(elements){for(var i=0,length=elements.length;i<length;i++){Element.extend(elements[i]);}
        return elements;}
    var K=Prototype.K;return{select:select,match:match,find:find,extendElements:(Element.extend===K)?K:extendElements,extendElement:Element.extend};})();
/*
 * Sizzle CSS Selector Engine - v1.0
 *  Copyright 2009, The Dojo Foundation
 *  Released under the MIT, BSD, and GPL Licenses.
 *  More information: http://sizzlejs.com/
 */
(function(){var chunker=/((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^[\]]*\]|['"][^'"]*['"]|[^[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,done=0,toString=Object.prototype.toString,hasDuplicate=false,baseHasDuplicate=true;[0,0].sort(function(){baseHasDuplicate=false;return 0;});var Sizzle=function(selector,context,results,seed){results=results||[];var origContext=context=context||document;if(context.nodeType!==1&&context.nodeType!==9){return[];}
    if(!selector||typeof selector!=="string"){return results;}
    var parts=[],m,set,checkSet,check,mode,extra,prune=true,contextXML=isXML(context),soFar=selector;while((chunker.exec(""),m=chunker.exec(soFar))!==null){soFar=m[3];parts.push(m[1]);if(m[2]){extra=m[3];break;}}
    if(parts.length>1&&origPOS.exec(selector)){if(parts.length===2&&Expr.relative[parts[0]]){set=posProcess(parts[0]+parts[1],context);}else{set=Expr.relative[parts[0]]?[context]:Sizzle(parts.shift(),context);while(parts.length){selector=parts.shift();if(Expr.relative[selector])
        selector+=parts.shift();set=posProcess(selector,set);}}}else{if(!seed&&parts.length>1&&context.nodeType===9&&!contextXML&&Expr.match.ID.test(parts[0])&&!Expr.match.ID.test(parts[parts.length-1])){var ret=Sizzle.find(parts.shift(),context,contextXML);context=ret.expr?Sizzle.filter(ret.expr,ret.set)[0]:ret.set[0];}
        if(context){var ret=seed?{expr:parts.pop(),set:makeArray(seed)}:Sizzle.find(parts.pop(),parts.length===1&&(parts[0]==="~"||parts[0]==="+")&&context.parentNode?context.parentNode:context,contextXML);set=ret.expr?Sizzle.filter(ret.expr,ret.set):ret.set;if(parts.length>0){checkSet=makeArray(set);}else{prune=false;}
            while(parts.length){var cur=parts.pop(),pop=cur;if(!Expr.relative[cur]){cur="";}else{pop=parts.pop();}
                if(pop==null){pop=context;}
                Expr.relative[cur](checkSet,pop,contextXML);}}else{checkSet=parts=[];}}
    if(!checkSet){checkSet=set;}
    if(!checkSet){throw"Syntax error, unrecognized expression: "+(cur||selector);}
    if(toString.call(checkSet)==="[object Array]"){if(!prune){results.push.apply(results,checkSet);}else if(context&&context.nodeType===1){for(var i=0;checkSet[i]!=null;i++){if(checkSet[i]&&(checkSet[i]===true||checkSet[i].nodeType===1&&contains(context,checkSet[i]))){results.push(set[i]);}}}else{for(var i=0;checkSet[i]!=null;i++){if(checkSet[i]&&checkSet[i].nodeType===1){results.push(set[i]);}}}}else{makeArray(checkSet,results);}
    if(extra){Sizzle(extra,origContext,results,seed);Sizzle.uniqueSort(results);}
    return results;};Sizzle.uniqueSort=function(results){if(sortOrder){hasDuplicate=baseHasDuplicate;results.sort(sortOrder);if(hasDuplicate){for(var i=1;i<results.length;i++){if(results[i]===results[i-1]){results.splice(i--,1);}}}}
    return results;};Sizzle.matches=function(expr,set){return Sizzle(expr,null,null,set);};Sizzle.find=function(expr,context,isXML){var set,match;if(!expr){return[];}
    for(var i=0,l=Expr.order.length;i<l;i++){var type=Expr.order[i],match;if((match=Expr.leftMatch[type].exec(expr))){var left=match[1];match.splice(1,1);if(left.substr(left.length-1)!=="\\"){match[1]=(match[1]||"").replace(/\\/g,"");set=Expr.find[type](match,context,isXML);if(set!=null){expr=expr.replace(Expr.match[type],"");break;}}}}
    if(!set){set=context.getElementsByTagName("*");}
    return{set:set,expr:expr};};Sizzle.filter=function(expr,set,inplace,not){var old=expr,result=[],curLoop=set,match,anyFound,isXMLFilter=set&&set[0]&&isXML(set[0]);while(expr&&set.length){for(var type in Expr.filter){if((match=Expr.match[type].exec(expr))!=null){var filter=Expr.filter[type],found,item;anyFound=false;if(curLoop==result){result=[];}
    if(Expr.preFilter[type]){match=Expr.preFilter[type](match,curLoop,inplace,result,not,isXMLFilter);if(!match){anyFound=found=true;}else if(match===true){continue;}}
    if(match){for(var i=0;(item=curLoop[i])!=null;i++){if(item){found=filter(item,match,i,curLoop);var pass=not^!!found;if(inplace&&found!=null){if(pass){anyFound=true;}else{curLoop[i]=false;}}else if(pass){result.push(item);anyFound=true;}}}}
    if(found!==undefined){if(!inplace){curLoop=result;}
        expr=expr.replace(Expr.match[type],"");if(!anyFound){return[];}
        break;}}}
    if(expr==old){if(anyFound==null){throw"Syntax error, unrecognized expression: "+expr;}else{break;}}
    old=expr;}
    return curLoop;};var Expr=Sizzle.selectors={order:["ID","NAME","TAG"],match:{ID:/#((?:[\w\u00c0-\uFFFF-]|\\.)+)/,CLASS:/\.((?:[\w\u00c0-\uFFFF-]|\\.)+)/,NAME:/\[name=['"]*((?:[\w\u00c0-\uFFFF-]|\\.)+)['"]*\]/,ATTR:/\[\s*((?:[\w\u00c0-\uFFFF-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,TAG:/^((?:[\w\u00c0-\uFFFF\*-]|\\.)+)/,CHILD:/:(only|nth|last|first)-child(?:\((even|odd|[\dn+-]*)\))?/,POS:/:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^-]|$)/,PSEUDO:/:((?:[\w\u00c0-\uFFFF-]|\\.)+)(?:\((['"]*)((?:\([^\)]+\)|[^\2\(\)]*)+)\2\))?/},leftMatch:{},attrMap:{"class":"className","for":"htmlFor"},attrHandle:{href:function(elem){return elem.getAttribute("href");}},relative:{"+":function(checkSet,part,isXML){var isPartStr=typeof part==="string",isTag=isPartStr&&!/\W/.test(part),isPartStrNotTag=isPartStr&&!isTag;if(isTag&&!isXML){part=part.toUpperCase();}
    for(var i=0,l=checkSet.length,elem;i<l;i++){if((elem=checkSet[i])){while((elem=elem.previousSibling)&&elem.nodeType!==1){}
        checkSet[i]=isPartStrNotTag||elem&&elem.nodeName===part?elem||false:elem===part;}}
    if(isPartStrNotTag){Sizzle.filter(part,checkSet,true);}},">":function(checkSet,part,isXML){var isPartStr=typeof part==="string";if(isPartStr&&!/\W/.test(part)){part=isXML?part:part.toUpperCase();for(var i=0,l=checkSet.length;i<l;i++){var elem=checkSet[i];if(elem){var parent=elem.parentNode;checkSet[i]=parent.nodeName===part?parent:false;}}}else{for(var i=0,l=checkSet.length;i<l;i++){var elem=checkSet[i];if(elem){checkSet[i]=isPartStr?elem.parentNode:elem.parentNode===part;}}
    if(isPartStr){Sizzle.filter(part,checkSet,true);}}},"":function(checkSet,part,isXML){var doneName=done++,checkFn=dirCheck;if(!/\W/.test(part)){var nodeCheck=part=isXML?part:part.toUpperCase();checkFn=dirNodeCheck;}
    checkFn("parentNode",part,doneName,checkSet,nodeCheck,isXML);},"~":function(checkSet,part,isXML){var doneName=done++,checkFn=dirCheck;if(typeof part==="string"&&!/\W/.test(part)){var nodeCheck=part=isXML?part:part.toUpperCase();checkFn=dirNodeCheck;}
    checkFn("previousSibling",part,doneName,checkSet,nodeCheck,isXML);}},find:{ID:function(match,context,isXML){if(typeof context.getElementById!=="undefined"&&!isXML){var m=context.getElementById(match[1]);return m?[m]:[];}},NAME:function(match,context,isXML){if(typeof context.getElementsByName!=="undefined"){var ret=[],results=context.getElementsByName(match[1]);for(var i=0,l=results.length;i<l;i++){if(results[i].getAttribute("name")===match[1]){ret.push(results[i]);}}
    return ret.length===0?null:ret;}},TAG:function(match,context){return context.getElementsByTagName(match[1]);}},preFilter:{CLASS:function(match,curLoop,inplace,result,not,isXML){match=" "+match[1].replace(/\\/g,"")+" ";if(isXML){return match;}
    for(var i=0,elem;(elem=curLoop[i])!=null;i++){if(elem){if(not^(elem.className&&(" "+elem.className+" ").indexOf(match)>=0)){if(!inplace)
        result.push(elem);}else if(inplace){curLoop[i]=false;}}}
    return false;},ID:function(match){return match[1].replace(/\\/g,"");},TAG:function(match,curLoop){for(var i=0;curLoop[i]===false;i++){}
    return curLoop[i]&&isXML(curLoop[i])?match[1]:match[1].toUpperCase();},CHILD:function(match){if(match[1]=="nth"){var test=/(-?)(\d*)n((?:\+|-)?\d*)/.exec(match[2]=="even"&&"2n"||match[2]=="odd"&&"2n+1"||!/\D/.test(match[2])&&"0n+"+match[2]||match[2]);match[2]=(test[1]+(test[2]||1))-0;match[3]=test[3]-0;}
    match[0]=done++;return match;},ATTR:function(match,curLoop,inplace,result,not,isXML){var name=match[1].replace(/\\/g,"");if(!isXML&&Expr.attrMap[name]){match[1]=Expr.attrMap[name];}
    if(match[2]==="~="){match[4]=" "+match[4]+" ";}
    return match;},PSEUDO:function(match,curLoop,inplace,result,not){if(match[1]==="not"){if((chunker.exec(match[3])||"").length>1||/^\w/.test(match[3])){match[3]=Sizzle(match[3],null,null,curLoop);}else{var ret=Sizzle.filter(match[3],curLoop,inplace,true^not);if(!inplace){result.push.apply(result,ret);}
    return false;}}else if(Expr.match.POS.test(match[0])||Expr.match.CHILD.test(match[0])){return true;}
    return match;},POS:function(match){match.unshift(true);return match;}},filters:{enabled:function(elem){return elem.disabled===false&&elem.type!=="hidden";},disabled:function(elem){return elem.disabled===true;},checked:function(elem){return elem.checked===true;},selected:function(elem){elem.parentNode.selectedIndex;return elem.selected===true;},parent:function(elem){return!!elem.firstChild;},empty:function(elem){return!elem.firstChild;},has:function(elem,i,match){return!!Sizzle(match[3],elem).length;},header:function(elem){return /h\d/i.test(elem.nodeName);},text:function(elem){return"text"===elem.type;},radio:function(elem){return"radio"===elem.type;},checkbox:function(elem){return"checkbox"===elem.type;},file:function(elem){return"file"===elem.type;},password:function(elem){return"password"===elem.type;},submit:function(elem){return"submit"===elem.type;},image:function(elem){return"image"===elem.type;},reset:function(elem){return"reset"===elem.type;},button:function(elem){return"button"===elem.type||elem.nodeName.toUpperCase()==="BUTTON";},input:function(elem){return /input|select|textarea|button/i.test(elem.nodeName);}},setFilters:{first:function(elem,i){return i===0;},last:function(elem,i,match,array){return i===array.length-1;},even:function(elem,i){return i%2===0;},odd:function(elem,i){return i%2===1;},lt:function(elem,i,match){return i<match[3]-0;},gt:function(elem,i,match){return i>match[3]-0;},nth:function(elem,i,match){return match[3]-0==i;},eq:function(elem,i,match){return match[3]-0==i;}},filter:{PSEUDO:function(elem,match,i,array){var name=match[1],filter=Expr.filters[name];if(filter){return filter(elem,i,match,array);}else if(name==="contains"){return(elem.textContent||elem.innerText||"").indexOf(match[3])>=0;}else if(name==="not"){var not=match[3];for(var i=0,l=not.length;i<l;i++){if(not[i]===elem){return false;}}
    return true;}},CHILD:function(elem,match){var type=match[1],node=elem;switch(type){case'only':case'first':while((node=node.previousSibling)){if(node.nodeType===1)return false;}
    if(type=='first')return true;node=elem;case'last':while((node=node.nextSibling)){if(node.nodeType===1)return false;}
    return true;case'nth':var first=match[2],last=match[3];if(first==1&&last==0){return true;}
    var doneName=match[0],parent=elem.parentNode;if(parent&&(parent.sizcache!==doneName||!elem.nodeIndex)){var count=0;for(node=parent.firstChild;node;node=node.nextSibling){if(node.nodeType===1){node.nodeIndex=++count;}}
        parent.sizcache=doneName;}
    var diff=elem.nodeIndex-last;if(first==0){return diff==0;}else{return(diff%first==0&&diff/first>=0);}}},ID:function(elem,match){return elem.nodeType===1&&elem.getAttribute("id")===match;},TAG:function(elem,match){return(match==="*"&&elem.nodeType===1)||elem.nodeName===match;},CLASS:function(elem,match){return(" "+(elem.className||elem.getAttribute("class"))+" ").indexOf(match)>-1;},ATTR:function(elem,match){var name=match[1],result=Expr.attrHandle[name]?Expr.attrHandle[name](elem):elem[name]!=null?elem[name]:elem.getAttribute(name),value=result+"",type=match[2],check=match[4];return result==null?type==="!=":type==="="?value===check:type==="*="?value.indexOf(check)>=0:type==="~="?(" "+value+" ").indexOf(check)>=0:!check?value&&result!==false:type==="!="?value!=check:type==="^="?value.indexOf(check)===0:type==="$="?value.substr(value.length-check.length)===check:type==="|="?value===check||value.substr(0,check.length+1)===check+"-":false;},POS:function(elem,match,i,array){var name=match[2],filter=Expr.setFilters[name];if(filter){return filter(elem,i,match,array);}}}};var origPOS=Expr.match.POS;for(var type in Expr.match){Expr.match[type]=new RegExp(Expr.match[type].source+/(?![^\[]*\])(?![^\(]*\))/.source);Expr.leftMatch[type]=new RegExp(/(^(?:.|\r|\n)*?)/.source+Expr.match[type].source);}
    var makeArray=function(array,results){array=Array.prototype.slice.call(array,0);if(results){results.push.apply(results,array);return results;}
        return array;};try{Array.prototype.slice.call(document.documentElement.childNodes,0);}catch(e){makeArray=function(array,results){var ret=results||[];if(toString.call(array)==="[object Array]"){Array.prototype.push.apply(ret,array);}else{if(typeof array.length==="number"){for(var i=0,l=array.length;i<l;i++){ret.push(array[i]);}}else{for(var i=0;array[i];i++){ret.push(array[i]);}}}
        return ret;};}
    var sortOrder;if(document.documentElement.compareDocumentPosition){sortOrder=function(a,b){if(!a.compareDocumentPosition||!b.compareDocumentPosition){if(a==b){hasDuplicate=true;}
        return 0;}
        var ret=a.compareDocumentPosition(b)&4?-1:a===b?0:1;if(ret===0){hasDuplicate=true;}
        return ret;};}else if("sourceIndex"in document.documentElement){sortOrder=function(a,b){if(!a.sourceIndex||!b.sourceIndex){if(a==b){hasDuplicate=true;}
        return 0;}
        var ret=a.sourceIndex-b.sourceIndex;if(ret===0){hasDuplicate=true;}
        return ret;};}else if(document.createRange){sortOrder=function(a,b){if(!a.ownerDocument||!b.ownerDocument){if(a==b){hasDuplicate=true;}
        return 0;}
        var aRange=a.ownerDocument.createRange(),bRange=b.ownerDocument.createRange();aRange.setStart(a,0);aRange.setEnd(a,0);bRange.setStart(b,0);bRange.setEnd(b,0);var ret=aRange.compareBoundaryPoints(Range.START_TO_END,bRange);if(ret===0){hasDuplicate=true;}
        return ret;};}
    (function(){var form=document.createElement("div"),id="script"+(new Date).getTime();form.innerHTML="<a name='"+id+"'/>";var root=document.documentElement;root.insertBefore(form,root.firstChild);if(!!document.getElementById(id)){Expr.find.ID=function(match,context,isXML){if(typeof context.getElementById!=="undefined"&&!isXML){var m=context.getElementById(match[1]);return m?m.id===match[1]||typeof m.getAttributeNode!=="undefined"&&m.getAttributeNode("id").nodeValue===match[1]?[m]:undefined:[];}};Expr.filter.ID=function(elem,match){var node=typeof elem.getAttributeNode!=="undefined"&&elem.getAttributeNode("id");return elem.nodeType===1&&node&&node.nodeValue===match;};}
        root.removeChild(form);root=form=null;})();(function(){var div=document.createElement("div");div.appendChild(document.createComment(""));if(div.getElementsByTagName("*").length>0){Expr.find.TAG=function(match,context){var results=context.getElementsByTagName(match[1]);if(match[1]==="*"){var tmp=[];for(var i=0;results[i];i++){if(results[i].nodeType===1){tmp.push(results[i]);}}
        results=tmp;}
        return results;};}
        div.innerHTML="<a href='#'></a>";if(div.firstChild&&typeof div.firstChild.getAttribute!=="undefined"&&div.firstChild.getAttribute("href")!=="#"){Expr.attrHandle.href=function(elem){return elem.getAttribute("href",2);};}
        div=null;})();if(document.querySelectorAll)(function(){var oldSizzle=Sizzle,div=document.createElement("div");div.innerHTML="<p class='TEST'></p>";if(div.querySelectorAll&&div.querySelectorAll(".TEST").length===0){return;}
        Sizzle=function(query,context,extra,seed){context=context||document;if(!seed&&context.nodeType===9&&!isXML(context)){try{return makeArray(context.querySelectorAll(query),extra);}catch(e){}}
            return oldSizzle(query,context,extra,seed);};for(var prop in oldSizzle){Sizzle[prop]=oldSizzle[prop];}
        div=null;})();if(document.getElementsByClassName&&document.documentElement.getElementsByClassName)(function(){var div=document.createElement("div");div.innerHTML="<div class='test e'></div><div class='test'></div>";if(div.getElementsByClassName("e").length===0)
        return;div.lastChild.className="e";if(div.getElementsByClassName("e").length===1)
        return;Expr.order.splice(1,0,"CLASS");Expr.find.CLASS=function(match,context,isXML){if(typeof context.getElementsByClassName!=="undefined"&&!isXML){return context.getElementsByClassName(match[1]);}};div=null;})();function dirNodeCheck(dir,cur,doneName,checkSet,nodeCheck,isXML){var sibDir=dir=="previousSibling"&&!isXML;for(var i=0,l=checkSet.length;i<l;i++){var elem=checkSet[i];if(elem){if(sibDir&&elem.nodeType===1){elem.sizcache=doneName;elem.sizset=i;}
        elem=elem[dir];var match=false;while(elem){if(elem.sizcache===doneName){match=checkSet[elem.sizset];break;}
            if(elem.nodeType===1&&!isXML){elem.sizcache=doneName;elem.sizset=i;}
            if(elem.nodeName===cur){match=elem;break;}
            elem=elem[dir];}
        checkSet[i]=match;}}}
    function dirCheck(dir,cur,doneName,checkSet,nodeCheck,isXML){var sibDir=dir=="previousSibling"&&!isXML;for(var i=0,l=checkSet.length;i<l;i++){var elem=checkSet[i];if(elem){if(sibDir&&elem.nodeType===1){elem.sizcache=doneName;elem.sizset=i;}
        elem=elem[dir];var match=false;while(elem){if(elem.sizcache===doneName){match=checkSet[elem.sizset];break;}
            if(elem.nodeType===1){if(!isXML){elem.sizcache=doneName;elem.sizset=i;}
                if(typeof cur!=="string"){if(elem===cur){match=true;break;}}else if(Sizzle.filter(cur,[elem]).length>0){match=elem;break;}}
            elem=elem[dir];}
        checkSet[i]=match;}}}
    var contains=document.compareDocumentPosition?function(a,b){return a.compareDocumentPosition(b)&16;}:function(a,b){return a!==b&&(a.contains?a.contains(b):true);};var isXML=function(elem){return elem.nodeType===9&&elem.documentElement.nodeName!=="HTML"||!!elem.ownerDocument&&elem.ownerDocument.documentElement.nodeName!=="HTML";};var posProcess=function(selector,context){var tmpSet=[],later="",match,root=context.nodeType?[context]:context;while((match=Expr.match.PSEUDO.exec(selector))){later+=match[0];selector=selector.replace(Expr.match.PSEUDO,"");}
        selector=Expr.relative[selector]?selector+"*":selector;for(var i=0,l=root.length;i<l;i++){Sizzle(selector,root[i],tmpSet);}
        return Sizzle.filter(later,tmpSet);};window.Sizzle=Sizzle;})();Prototype._original_property=window.Sizzle;;(function(engine){var extendElements=Prototype.Selector.extendElements;function select(selector,scope){return extendElements(engine(selector,scope||document));}
    function match(element,selector){return engine.matches(selector,[element]).length==1;}
    Prototype.Selector.engine=engine;Prototype.Selector.select=select;Prototype.Selector.match=match;})(Sizzle);window.Sizzle=Prototype._original_property;delete Prototype._original_property;var Form={reset:function(form){form=$(form);form.reset();return form;},serializeElements:function(elements,options){if(typeof options!='object')options={hash:!!options};else if(Object.isUndefined(options.hash))options.hash=true;var key,value,submitted=false,submit=options.submit,accumulator,initial;if(options.hash){initial={};accumulator=function(result,key,value){if(key in result){if(!Object.isArray(result[key]))result[key]=[result[key]];result[key].push(value);}else result[key]=value;return result;};}else{initial='';accumulator=function(result,key,value){return result+(result?'&':'')+encodeURIComponent(key)+'='+encodeURIComponent(value);}}
    return elements.inject(initial,function(result,element){if(!element.disabled&&element.name){key=element.name;value=$(element).getValue();if(value!=null&&element.type!='file'&&(element.type!='submit'||(!submitted&&submit!==false&&(!submit||key==submit)&&(submitted=true)))){result=accumulator(result,key,value);}}
        return result;});}};Form.Methods={serialize:function(form,options){return Form.serializeElements(Form.getElements(form),options);},getElements:function(form){var elements=$(form).getElementsByTagName('*'),element,arr=[],serializers=Form.Element.Serializers;for(var i=0;element=elements[i];i++){arr.push(element);}
    return arr.inject([],function(elements,child){if(serializers[child.tagName.toLowerCase()])
        elements.push(Element.extend(child));return elements;})},getInputs:function(form,typeName,name){form=$(form);var inputs=form.getElementsByTagName('input');if(!typeName&&!name)return $A(inputs).map(Element.extend);for(var i=0,matchingInputs=[],length=inputs.length;i<length;i++){var input=inputs[i];if((typeName&&input.type!=typeName)||(name&&input.name!=name))
    continue;matchingInputs.push(Element.extend(input));}
    return matchingInputs;},disable:function(form){form=$(form);Form.getElements(form).invoke('disable');return form;},enable:function(form){form=$(form);Form.getElements(form).invoke('enable');return form;},findFirstElement:function(form){var elements=$(form).getElements().findAll(function(element){return'hidden'!=element.type&&!element.disabled;});var firstByIndex=elements.findAll(function(element){return element.hasAttribute('tabIndex')&&element.tabIndex>=0;}).sortBy(function(element){return element.tabIndex}).first();return firstByIndex?firstByIndex:elements.find(function(element){return /^(?:input|select|textarea)$/i.test(element.tagName);});},focusFirstElement:function(form){form=$(form);var element=form.findFirstElement();if(element)element.activate();return form;},request:function(form,options){form=$(form),options=Object.clone(options||{});var params=options.parameters,action=form.readAttribute('action')||'';if(action.blank())action=window.location.href;options.parameters=form.serialize(true);if(params){if(Object.isString(params))params=params.toQueryParams();Object.extend(options.parameters,params);}
    if(form.hasAttribute('method')&&!options.method)
        options.method=form.method;return new Ajax.Request(action,options);}};Form.Element={focus:function(element){$(element).focus();return element;},select:function(element){$(element).select();return element;}};Form.Element.Methods={serialize:function(element){element=$(element);if(!element.disabled&&element.name){var value=element.getValue();if(value!=undefined){var pair={};pair[element.name]=value;return Object.toQueryString(pair);}}
    return'';},getValue:function(element){element=$(element);var method=element.tagName.toLowerCase();return Form.Element.Serializers[method](element);},setValue:function(element,value){element=$(element);var method=element.tagName.toLowerCase();Form.Element.Serializers[method](element,value);return element;},clear:function(element){$(element).value='';return element;},present:function(element){return $(element).value!='';},activate:function(element){element=$(element);try{element.focus();if(element.select&&(element.tagName.toLowerCase()!='input'||!(/^(?:button|reset|submit)$/i.test(element.type))))
    element.select();}catch(e){}
    return element;},disable:function(element){element=$(element);element.disabled=true;return element;},enable:function(element){element=$(element);element.disabled=false;return element;}};var Field=Form.Element;var $F=Form.Element.Methods.getValue;Form.Element.Serializers=(function(){function input(element,value){switch(element.type.toLowerCase()){case'checkbox':case'radio':return inputSelector(element,value);default:return valueSelector(element,value);}}
    function inputSelector(element,value){if(Object.isUndefined(value))
        return element.checked?element.value:null;else element.checked=!!value;}
    function valueSelector(element,value){if(Object.isUndefined(value))return element.value;else element.value=value;}
    function select(element,value){if(Object.isUndefined(value))
        return(element.type==='select-one'?selectOne:selectMany)(element);var opt,currentValue,single=!Object.isArray(value);for(var i=0,length=element.length;i<length;i++){opt=element.options[i];currentValue=this.optionValue(opt);if(single){if(currentValue==value){opt.selected=true;return;}}
    else opt.selected=value.include(currentValue);}}
    function selectOne(element){var index=element.selectedIndex;return index>=0?optionValue(element.options[index]):null;}
    function selectMany(element){var values,length=element.length;if(!length)return null;for(var i=0,values=[];i<length;i++){var opt=element.options[i];if(opt.selected)values.push(optionValue(opt));}
        return values;}
    function optionValue(opt){return Element.hasAttribute(opt,'value')?opt.value:opt.text;}
    return{input:input,inputSelector:inputSelector,textarea:valueSelector,select:select,selectOne:selectOne,selectMany:selectMany,optionValue:optionValue,button:valueSelector};})();Abstract.TimedObserver=Class.create(PeriodicalExecuter,{initialize:function($super,element,frequency,callback){$super(callback,frequency);this.element=$(element);this.lastValue=this.getValue();},execute:function(){var value=this.getValue();if(Object.isString(this.lastValue)&&Object.isString(value)?this.lastValue!=value:String(this.lastValue)!=String(value)){this.callback(this.element,value);this.lastValue=value;}}});Form.Element.Observer=Class.create(Abstract.TimedObserver,{getValue:function(){return Form.Element.getValue(this.element);}});Form.Observer=Class.create(Abstract.TimedObserver,{getValue:function(){return Form.serialize(this.element);}});Abstract.EventObserver=Class.create({initialize:function(element,callback){this.element=$(element);this.callback=callback;this.lastValue=this.getValue();if(this.element.tagName.toLowerCase()=='form')
    this.registerFormCallbacks();else
    this.registerCallback(this.element);},onElementEvent:function(){var value=this.getValue();if(this.lastValue!=value){this.callback(this.element,value);this.lastValue=value;}},registerFormCallbacks:function(){Form.getElements(this.element).each(this.registerCallback,this);},registerCallback:function(element){if(element.type){switch(element.type.toLowerCase()){case'checkbox':case'radio':Event.observe(element,'click',this.onElementEvent.bind(this));break;default:Event.observe(element,'change',this.onElementEvent.bind(this));break;}}}});Form.Element.EventObserver=Class.create(Abstract.EventObserver,{getValue:function(){return Form.Element.getValue(this.element);}});Form.EventObserver=Class.create(Abstract.EventObserver,{getValue:function(){return Form.serialize(this.element);}});(function(){var Event={KEY_BACKSPACE:8,KEY_TAB:9,KEY_RETURN:13,KEY_ESC:27,KEY_LEFT:37,KEY_UP:38,KEY_RIGHT:39,KEY_DOWN:40,KEY_DELETE:46,KEY_HOME:36,KEY_END:35,KEY_PAGEUP:33,KEY_PAGEDOWN:34,KEY_INSERT:45,cache:{}};var docEl=document.documentElement;var MOUSEENTER_MOUSELEAVE_EVENTS_SUPPORTED='onmouseenter'in docEl&&'onmouseleave'in docEl;var isIELegacyEvent=function(event){return false;};if(window.attachEvent){if(window.addEventListener){isIELegacyEvent=function(event){return!(event instanceof window.Event);};}else{isIELegacyEvent=function(event){return true;};}}
    var _isButton;function _isButtonForDOMEvents(event,code){return event.which?(event.which===code+1):(event.button===code);}
    var legacyButtonMap={0:1,1:4,2:2};function _isButtonForLegacyEvents(event,code){return event.button===legacyButtonMap[code];}
    function _isButtonForWebKit(event,code){switch(code){case 0:return event.which==1&&!event.metaKey;case 1:return event.which==2||(event.which==1&&event.metaKey);case 2:return event.which==3;default:return false;}}
    if(window.attachEvent){if(!window.addEventListener){_isButton=_isButtonForLegacyEvents;}else{_isButton=function(event,code){return isIELegacyEvent(event)?_isButtonForLegacyEvents(event,code):_isButtonForDOMEvents(event,code);}}}else if(Prototype.Browser.WebKit){_isButton=_isButtonForWebKit;}else{_isButton=_isButtonForDOMEvents;}
    function isLeftClick(event){return _isButton(event,0)}
    function isMiddleClick(event){return _isButton(event,1)}
    function isRightClick(event){return _isButton(event,2)}
    function element(event){event=Event.extend(event);var node=event.target,type=event.type,currentTarget=event.currentTarget;if(currentTarget&&currentTarget.tagName){if(type==='load'||type==='error'||(type==='click'&&currentTarget.tagName.toLowerCase()==='input'&&currentTarget.type==='radio'))
        node=currentTarget;}
        if(node.nodeType==Node.TEXT_NODE)
            node=node.parentNode;return Element.extend(node);}
    function findElement(event,expression){var element=Event.element(event);if(!expression)return element;while(element){if(Object.isElement(element)&&Prototype.Selector.match(element,expression)){return Element.extend(element);}
        element=element.parentNode;}}
    function pointer(event){return{x:pointerX(event),y:pointerY(event)};}
    function pointerX(event){var docElement=document.documentElement,body=document.body||{scrollLeft:0};return event.pageX||(event.clientX+
        (docElement.scrollLeft||body.scrollLeft)-
        (docElement.clientLeft||0));}
    function pointerY(event){var docElement=document.documentElement,body=document.body||{scrollTop:0};return event.pageY||(event.clientY+
        (docElement.scrollTop||body.scrollTop)-
        (docElement.clientTop||0));}
    function stop(event){Event.extend(event);event.preventDefault();event.stopPropagation();event.stopped=true;}
    Event.Methods={isLeftClick:isLeftClick,isMiddleClick:isMiddleClick,isRightClick:isRightClick,element:element,findElement:findElement,pointer:pointer,pointerX:pointerX,pointerY:pointerY,stop:stop};var methods=Object.keys(Event.Methods).inject({},function(m,name){m[name]=Event.Methods[name].methodize();return m;});if(window.attachEvent){function _relatedTarget(event){var element;switch(event.type){case'mouseover':case'mouseenter':element=event.fromElement;break;case'mouseout':case'mouseleave':element=event.toElement;break;default:return null;}
        return Element.extend(element);}
        var additionalMethods={stopPropagation:function(){this.cancelBubble=true},preventDefault:function(){this.returnValue=false},inspect:function(){return'[object Event]'}};Event.extend=function(event,element){if(!event)return false;if(!isIELegacyEvent(event))return event;if(event._extendedByPrototype)return event;event._extendedByPrototype=Prototype.emptyFunction;var pointer=Event.pointer(event);Object.extend(event,{target:event.srcElement||element,relatedTarget:_relatedTarget(event),pageX:pointer.x,pageY:pointer.y});Object.extend(event,methods);Object.extend(event,additionalMethods);return event;};}else{Event.extend=Prototype.K;}
    if(window.addEventListener){Event.prototype=window.Event.prototype||document.createEvent('HTMLEvents').__proto__;Object.extend(Event.prototype,methods);}
    function _createResponder(element,eventName,handler){var registry=Element.retrieve(element,'prototype_event_registry');if(Object.isUndefined(registry)){CACHE.push(element);registry=Element.retrieve(element,'prototype_event_registry',$H());}
        var respondersForEvent=registry.get(eventName);if(Object.isUndefined(respondersForEvent)){respondersForEvent=[];registry.set(eventName,respondersForEvent);}
        if(respondersForEvent.pluck('handler').include(handler))return false;var responder;if(eventName.include(":")){responder=function(event){if(Object.isUndefined(event.eventName))
            return false;if(event.eventName!==eventName)
            return false;Event.extend(event,element);handler.call(element,event);};}else{if(!MOUSEENTER_MOUSELEAVE_EVENTS_SUPPORTED&&(eventName==="mouseenter"||eventName==="mouseleave")){if(eventName==="mouseenter"||eventName==="mouseleave"){responder=function(event){Event.extend(event,element);var parent=event.relatedTarget;while(parent&&parent!==element){try{parent=parent.parentNode;}
        catch(e){parent=element;}}
            if(parent===element)return;handler.call(element,event);};}}else{responder=function(event){Event.extend(event,element);handler.call(element,event);};}}
        responder.handler=handler;respondersForEvent.push(responder);return responder;}
    function _destroyCache(){for(var i=0,length=CACHE.length;i<length;i++){Event.stopObserving(CACHE[i]);CACHE[i]=null;}}
    var CACHE=[];if(Prototype.Browser.IE)
        window.attachEvent('onunload',_destroyCache);if(Prototype.Browser.WebKit)
        window.addEventListener('unload',Prototype.emptyFunction,false);var _getDOMEventName=Prototype.K,translations={mouseenter:"mouseover",mouseleave:"mouseout"};if(!MOUSEENTER_MOUSELEAVE_EVENTS_SUPPORTED){_getDOMEventName=function(eventName){return(translations[eventName]||eventName);};}
    function observe(element,eventName,handler){element=$(element);var responder=_createResponder(element,eventName,handler);if(!responder)return element;if(eventName.include(':')){if(element.addEventListener)
        element.addEventListener("dataavailable",responder,false);else{element.attachEvent("ondataavailable",responder);element.attachEvent("onlosecapture",responder);}}else{var actualEventName=_getDOMEventName(eventName);if(element.addEventListener)
        element.addEventListener(actualEventName,responder,false);else
        element.attachEvent("on"+actualEventName,responder);}
        return element;}
    function stopObserving(element,eventName,handler){element=$(element);var registry=Element.retrieve(element,'prototype_event_registry');if(!registry)return element;if(!eventName){registry.each(function(pair){var eventName=pair.key;stopObserving(element,eventName);});return element;}
        var responders=registry.get(eventName);if(!responders)return element;if(!handler){responders.each(function(r){stopObserving(element,eventName,r.handler);});return element;}
        var i=responders.length,responder;while(i--){if(responders[i].handler===handler){responder=responders[i];break;}}
        if(!responder)return element;if(eventName.include(':')){if(element.removeEventListener)
            element.removeEventListener("dataavailable",responder,false);else{element.detachEvent("ondataavailable",responder);element.detachEvent("onlosecapture",responder);}}else{var actualEventName=_getDOMEventName(eventName);if(element.removeEventListener)
            element.removeEventListener(actualEventName,responder,false);else
            element.detachEvent('on'+actualEventName,responder);}
        registry.set(eventName,responders.without(responder));return element;}
    function fire(element,eventName,memo,bubble){element=$(element);if(Object.isUndefined(bubble))
        bubble=true;if(element==document&&document.createEvent&&!element.dispatchEvent)
        element=document.documentElement;var event;if(document.createEvent){event=document.createEvent('HTMLEvents');event.initEvent('dataavailable',bubble,true);}else{event=document.createEventObject();event.eventType=bubble?'ondataavailable':'onlosecapture';}
        event.eventName=eventName;event.memo=memo||{};if(document.createEvent)
            element.dispatchEvent(event);else
            element.fireEvent(event.eventType,event);return Event.extend(event);}
    Event.Handler=Class.create({initialize:function(element,eventName,selector,callback){this.element=$(element);this.eventName=eventName;this.selector=selector;this.callback=callback;this.handler=this.handleEvent.bind(this);},start:function(){Event.observe(this.element,this.eventName,this.handler);return this;},stop:function(){Event.stopObserving(this.element,this.eventName,this.handler);return this;},handleEvent:function(event){var element=Event.findElement(event,this.selector);if(element)this.callback.call(this.element,event,element);}});function on(element,eventName,selector,callback){element=$(element);if(Object.isFunction(selector)&&Object.isUndefined(callback)){callback=selector,selector=null;}
        return new Event.Handler(element,eventName,selector,callback).start();}
    Object.extend(Event,Event.Methods);Object.extend(Event,{fire:fire,observe:observe,stopObserving:stopObserving,on:on});Element.addMethods({fire:fire,observe:observe,stopObserving:stopObserving,on:on});Object.extend(document,{fire:fire.methodize(),observe:observe.methodize(),stopObserving:stopObserving.methodize(),on:on.methodize(),loaded:false});if(window.Event)Object.extend(window.Event,Event);else window.Event=Event;})();(function(){var timer;function fireContentLoadedEvent(){if(document.loaded)return;if(timer)window.clearTimeout(timer);document.loaded=true;document.fire('dom:loaded');}
    function checkReadyState(){if(document.readyState==='complete'){document.stopObserving('readystatechange',checkReadyState);fireContentLoadedEvent();}}
    function pollDoScroll(){try{document.documentElement.doScroll('left');}
    catch(e){timer=pollDoScroll.defer();return;}
        fireContentLoadedEvent();}
    if(document.addEventListener){document.addEventListener('DOMContentLoaded',fireContentLoadedEvent,false);}else{document.observe('readystatechange',checkReadyState);if(window==top)
        timer=pollDoScroll.defer();}
    Event.observe(window,'load',fireContentLoadedEvent);})();Element.addMethods();Hash.toQueryString=Object.toQueryString;var Toggle={display:Element.toggle};Element.Methods.childOf=Element.Methods.descendantOf;var Insertion={Before:function(element,content){return Element.insert(element,{before:content});},Top:function(element,content){return Element.insert(element,{top:content});},Bottom:function(element,content){return Element.insert(element,{bottom:content});},After:function(element,content){return Element.insert(element,{after:content});}};var $continue=new Error('"throw $continue" is deprecated, use "return" instead');var Position={includeScrollOffsets:false,prepare:function(){this.deltaX=window.pageXOffset||document.documentElement.scrollLeft||document.body.scrollLeft||0;this.deltaY=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop||0;},within:function(element,x,y){if(this.includeScrollOffsets)
    return this.withinIncludingScrolloffsets(element,x,y);this.xcomp=x;this.ycomp=y;this.offset=Element.cumulativeOffset(element);return(y>=this.offset[1]&&y<this.offset[1]+element.offsetHeight&&x>=this.offset[0]&&x<this.offset[0]+element.offsetWidth);},withinIncludingScrolloffsets:function(element,x,y){var offsetcache=Element.cumulativeScrollOffset(element);this.xcomp=x+offsetcache[0]-this.deltaX;this.ycomp=y+offsetcache[1]-this.deltaY;this.offset=Element.cumulativeOffset(element);return(this.ycomp>=this.offset[1]&&this.ycomp<this.offset[1]+element.offsetHeight&&this.xcomp>=this.offset[0]&&this.xcomp<this.offset[0]+element.offsetWidth);},overlap:function(mode,element){if(!mode)return 0;if(mode=='vertical')
    return((this.offset[1]+element.offsetHeight)-this.ycomp)/element.offsetHeight;if(mode=='horizontal')
    return((this.offset[0]+element.offsetWidth)-this.xcomp)/element.offsetWidth;},cumulativeOffset:Element.Methods.cumulativeOffset,positionedOffset:Element.Methods.positionedOffset,absolutize:function(element){Position.prepare();return Element.absolutize(element);},relativize:function(element){Position.prepare();return Element.relativize(element);},realOffset:Element.Methods.cumulativeScrollOffset,offsetParent:Element.Methods.getOffsetParent,page:Element.Methods.viewportOffset,clone:function(source,target,options){options=options||{};return Element.clonePosition(target,source,options);}};if(!document.getElementsByClassName)document.getElementsByClassName=function(instanceMethods){function iter(name){return name.blank()?null:"[contains(concat(' ', @class, ' '), ' "+name+" ')]";}
    instanceMethods.getElementsByClassName=Prototype.BrowserFeatures.XPath?function(element,className){className=className.toString().strip();var cond=/\s/.test(className)?$w(className).map(iter).join(''):iter(className);return cond?document._getElementsByXPath('.//*'+cond,element):[];}:function(element,className){className=className.toString().strip();var elements=[],classNames=(/\s/.test(className)?$w(className):null);if(!classNames&&!className)return elements;var nodes=$(element).getElementsByTagName('*');className=' '+className+' ';for(var i=0,child,cn;child=nodes[i];i++){if(child.className&&(cn=' '+child.className+' ')&&(cn.include(className)||(classNames&&classNames.all(function(name){return!name.toString().blank()&&cn.include(' '+name+' ');}))))
        elements.push(Element.extend(child));}
        return elements;};return function(className,parentElement){return $(parentElement||document.body).getElementsByClassName(className);};}(Element.Methods);Element.ClassNames=Class.create();Element.ClassNames.prototype={initialize:function(element){this.element=$(element);},_each:function(iterator){this.element.className.split(/\s+/).select(function(name){return name.length>0;})._each(iterator);},set:function(className){this.element.className=className;},add:function(classNameToAdd){if(this.include(classNameToAdd))return;this.set($A(this).concat(classNameToAdd).join(' '));},remove:function(classNameToRemove){if(!this.include(classNameToRemove))return;this.set($A(this).without(classNameToRemove).join(' '));},toString:function(){return $A(this).join(' ');}};Object.extend(Element.ClassNames.prototype,Enumerable);(function(){window.Selector=Class.create({initialize:function(expression){this.expression=expression.strip();},findElements:function(rootElement){return Prototype.Selector.select(this.expression,rootElement);},match:function(element){return Prototype.Selector.match(element,this.expression);},toString:function(){return this.expression;},inspect:function(){return"#<Selector: "+this.expression+">";}});Object.extend(Selector,{matchElements:function(elements,expression){var match=Prototype.Selector.match,results=[];for(var i=0,length=elements.length;i<length;i++){var element=elements[i];if(match(element,expression)){results.push(Element.extend(element));}}
    return results;},findElement:function(elements,expression,index){index=index||0;var matchIndex=0,element;for(var i=0,length=elements.length;i<length;i++){element=elements[i];if(Prototype.Selector.match(element,expression)&&index===matchIndex++){return Element.extend(element);}}},findChildElements:function(element,expressions){var selector=expressions.toArray().join(', ');return Prototype.Selector.select(selector,element||document);}});})();if(typeof(Control)=='undefined')
    var Control={};Control.Tabs=Class.create();Object.extend(Control.Tabs,{instances:[],findByTabId:function(id){return Control.Tabs.instances.find(function(tab){return tab.links.find(function(link){return link.key==id;});});}});Object.extend(Control.Tabs.prototype,{initialize:function(tab_list_container,options){var baseTag=document.getElementsByTagName('base');if(baseTag&&baseTag[0]){this.rootURL=baseTag[0].href;}else{this.rootURL=window.location.href;}
    this.activeContainer=false;this.activeLink=false;this.containers=$H({});this.links=[];Control.Tabs.instances.push(this);this.options={beforeChange:Prototype.emptyFunction,afterChange:Prototype.emptyFunction,hover:false,linkSelector:'li a',setClassOnContainer:false,activeClassName:'active',defaultTab:'first',autoLinkExternal:true,targetRegExp:/#(.+)$/,showFunction:Element.show,hideFunction:Element.hide};Object.extend(this.options,options||{});(typeof(this.options.linkSelector=='string')?$(tab_list_container).select(this.options.linkSelector):this.options.linkSelector($(tab_list_container))).findAll(function(link){return(/^#/).exec(link.href.replace(this.rootURL.split('#')[0],''));}.bind(this)).each(function(link){this.addTab(link);}.bind(this));this.containers.values().each(this.options.hideFunction);var active_link;if((active_link=this.links.find(function(link){return link.match('.'+this.options.activeClassName);}.bind(this)))){this.setActiveTab(active_link);}else if(this.options.defaultTab=='first')
        this.setActiveTab(this.links.first());else if(this.options.defaultTab=='last')
        this.setActiveTab(this.links.last());else
        this.setActiveTab(this.options.defaultTab);var targets=this.options.targetRegExp.exec(window.location);if(targets&&targets[1]){targets[1].split(',').each(function(target){this.links.each(function(target,link){if(link.key==target){this.setActiveTab(link);throw $break;}}.bind(this,target));}.bind(this));}
    if(this.options.autoLinkExternal){$A(document.getElementsByTagName('a')).each(function(a){if(!this.links.include(a)){var clean_href=a.href.replace(this.rootURL.split('#')[0],'');if(clean_href.substring(0,1)=='#'){if(this.containers.keys().include(clean_href.substring(1))){$(a).observe('click',function(event,clean_href){this.setActiveTab(clean_href.substring(1));}.bindAsEventListener(this,clean_href));}}}}.bind(this));}},addTab:function(link){this.links.push(link);link.key=link.getAttribute('href').replace(this.rootURL.split('#')[0],'').split('/').last().replace(/#/,'');this.containers.set(link.key,$(link.key));link[this.options.hover?'onmouseover':'onclick']=function(link){if(window.event)
    Event.stop(window.event);this.setActiveTab(link);return false;}.bind(this,link);},setActiveTab:function(link){if(!link)
    return;if(typeof(link)=='string'){this.links.each(function(_link){if(_link.key==link){this.setActiveTab(_link);throw $break;}}.bind(this));}else{this.notify('beforeChange',this.activeContainer);if(this.activeContainer)
    this.options.hideFunction(this.activeContainer);this.links.each(function(item){(this.options.setClassOnContainer?$(item.parentNode):item).removeClassName(this.options.activeClassName);}.bind(this));(this.options.setClassOnContainer?$(link.parentNode):link).addClassName(this.options.activeClassName);this.activeContainer=this.containers.get(link.key);this.activeLink=link;this.options.showFunction(this.containers.get(link.key));this.notify('afterChange',this.containers.get(link.key));}},next:function(){this.links.each(function(link,i){if(this.activeLink==link&&this.links[i+1]){this.setActiveTab(this.links[i+1]);throw $break;}else if(this.activeLink==link&&!this.links[i+1]){this.first();throw $break;}}.bind(this));return false;},previous:function(){this.links.each(function(link,i){if(this.activeLink==link&&this.links[i-1]){this.setActiveTab(this.links[i-1]);throw $break;}else if(this.activeLink==link&&this.links[i-1]){this.last();throw $break;}}.bind(this));return false;},first:function(){this.setActiveTab(this.links.first());return false;},last:function(){this.setActiveTab(this.links.last());return false;},notify:function(event_name){try{if(this.options[event_name])
    return[this.options[event_name].apply(this.options[event_name],$A(arguments).slice(1))];}catch(e){if(e!=$break)
    throw e;else
    return false;}}});if(typeof(Object.Event)!='undefined')
    Object.Event.extend(Control.Tabs);var tgs=new Array('div','td','tr','a');var szs=new Array('7pt','8pt','9pt','10pt','11pt','12pt','13pt');var startSz=1;function ts(trgt,inc){if(!document.getElementById)return
    var d=document,cEl=null,sz=startSz,i,j,cTags;sz+=inc;if(sz<0)sz=0;if(sz>6)sz=6;startSz=sz;if(!(cEl=d.getElementById(trgt)))cEl=d.getElementsByTagName(trgt)[0];cEl.style.fontSize=szs[sz];for(i=0;i<tgs.length;i++){cTags=cEl.getElementsByTagName(tgs[i]);for(j=0;j<cTags.length;j++)cTags[j].style.fontSize=szs[sz];}}
function tsz(trgt,sz){if(!document.getElementById)return
    var d=document,cEl=null,i,j,cTags;if(!(cEl=d.getElementById(trgt)))cEl=d.getElementsByTagName(trgt)[0];cEl.style.fontSize=sz;for(i=0;i<tgs.length;i++){cTags=cEl.getElementsByTagName(tgs[i]);for(j=0;j<cTags.length;j++)cTags[j].style.fontSize=sz;}}
function resizeShort(short,summary){short.setStyle({overflow:'hidden'});if(summary){var i=0;var text=summary.innerHTML.stripTags();summary.update(text);while(short.scrollHeight>short.offsetHeight){i++;if(i>100)break;var text=summary.innerHTML;summary.update(text.replace(/\W*\w+\W*$/,''));}}}


(function () {
    'use strict';

    function emulatedIEMajorVersion() {
        var groups = /MSIE ([0-9.]+)/.exec(window.navigator.userAgent)
        if (groups === null) {
            return null
        }
        var ieVersionNum = parseInt(groups[1], 10)
        var ieMajorVersion = Math.floor(ieVersionNum)
        return ieMajorVersion
    }

    function actualNonEmulatedIEMajorVersion() {

        var jscriptVersion = new Function('/*@cc_on return @_jscript_version; @*/')() // jshint ignore:line
        if (jscriptVersion === undefined) {
            return 11
        }
        if (jscriptVersion < 9) {
            return 8
        }
        return jscriptVersion
    }

    var ua = window.navigator.userAgent
    if (ua.indexOf('Opera') > -1 || ua.indexOf('Presto') > -1) {
        return
    }
    var emulated = emulatedIEMajorVersion()
    if (emulated === null) {
        return
    }
    var nonEmulated = actualNonEmulatedIEMajorVersion()

    if (emulated !== nonEmulated) {
        window.alert('WARNING: You appear to be using IE' + nonEmulated + ' in IE' + emulated + ' emulation mode.\nIE emulation modes can behave significantly differently from ACTUAL older versions of IE.\nPLEASE DON\'T FILE BOOTSTRAP BUGS based on testing in IE emulation modes!')
    }
})();




(function( $ ) {

    var _PLUGIN_	= 'mmenu',
        _VERSION_	= '4.1.9';


    //	Plugin already excists
    if ( $[ _PLUGIN_ ] )
    {
        return;
    }

    //	Global variables
    var glbl = {
        $wndw: null,
        $html: null,
        $body: null,
        $page: null,
        $blck: null,

        $allMenus: null,
        $scrollTopNode: null
    };

    var _c = {}, _e = {}, _d = {},
        _serialnr = 0;


    $[ _PLUGIN_ ] = function( $menu, opts, conf )
    {
        glbl.$allMenus = glbl.$allMenus.add( $menu );

        this.$menu = $menu;
        this.opts  = opts
        this.conf  = conf;

        this.serialnr = _serialnr++;

        this._init();

        return this;
    };

    $[ _PLUGIN_ ].prototype = {

        open: function()
        {
            this._openSetup();
            this._openFinish();
            return 'open';
        },
        _openSetup: function()
        {
            //	Find scrolltop
            var _scrollTop = findScrollTop();

            //	Set opened
            this.$menu.addClass( _c.current );

            //	Close others
            glbl.$allMenus.not( this.$menu ).trigger( _e.close );

            //	Store style and position
            glbl.$page
                .data( _d.style, glbl.$page.attr( 'style' ) || '' )
                .data( _d.scrollTop, _scrollTop )
                .data( _d.offetLeft, glbl.$page.offset().left );

            //	Resize page to window width
            var _w = 0;
            glbl.$wndw
                .off( _e.resize )
                .on( _e.resize,
                    function( e, force )
                    {
                        if ( force || glbl.$html.hasClass( _c.opened ) )
                        {
                            var nw = glbl.$wndw.width();
                            if ( nw != _w )
                            {
                                _w = nw;
                                glbl.$page.width( nw - glbl.$page.data( _d.offetLeft ) );
                            }
                        }
                    }
                )
                .trigger( _e.resize, [ true ] );

            //	Prevent tabbing out of the menu
            if ( this.conf.preventTabbing )
            {
                glbl.$wndw
                    .off( _e.keydown )
                    .on( _e.keydown,
                        function( e )
                        {
                            if ( e.keyCode == 9 )
                            {
                                e.preventDefault();
                                return false;
                            }
                        }
                    );
            }

            //	Add options
            if ( this.opts.modal )
            {
                glbl.$html.addClass( _c.modal );
            }
            if ( this.opts.moveBackground )
            {
                glbl.$html.addClass( _c.background );
            }
            if ( this.opts.position != 'left' )
            {
                glbl.$html.addClass( _c.mm( this.opts.position ) );
            }
            if ( this.opts.zposition != 'back' )
            {
                glbl.$html.addClass( _c.mm( this.opts.zposition ) );
            }
            if ( this.opts.classes )
            {
                glbl.$html.addClass( this.opts.classes );
            }

            //	Open
            glbl.$html.addClass( _c.opened );
            this.$menu.addClass( _c.opened );

            //	Scroll page to scrolltop
            glbl.$page.scrollTop( _scrollTop );

            //	Scroll menu to top
            this.$menu.scrollTop( 0 );
        },
        _openFinish: function()
        {
            var that = this;

            //	Callback
            transitionend( glbl.$page,
                function()
                {
                    that.$menu.trigger( _e.opened );
                }, this.conf.transitionDuration
            );

            //	Opening
            glbl.$html.addClass( _c.opening );
            this.$menu.trigger( _e.opening );

            //	Scroll window to top
            window.scrollTo( 0, 1 );
        },
        close: function()
        {
            var that = this;

            //	Callback
            transitionend( glbl.$page,
                function()
                {
                    that.$menu
                        .removeClass( _c.current )
                        .removeClass( _c.opened );

                    glbl.$html
                        .removeClass( _c.opened )
                        .removeClass( _c.modal )
                        .removeClass( _c.background )
                        .removeClass( _c.mm( that.opts.position ) )
                        .removeClass( _c.mm( that.opts.zposition ) );

                    if ( that.opts.classes )
                    {
                        glbl.$html.removeClass( that.opts.classes );
                    }

                    glbl.$wndw
                        .off( _e.resize )
                        .off( _e.keydown );

                    //	Restore style and position
                    glbl.$page.attr( 'style', glbl.$page.data( _d.style ) );

                    if ( glbl.$scrollTopNode )
                    {
                        glbl.$scrollTopNode.scrollTop( glbl.$page.data( _d.scrollTop ) );
                    }

                    //	Closed
                    that.$menu.trigger( _e.closed );

                }, this.conf.transitionDuration
            );

            //	Closing
            glbl.$html.removeClass( _c.opening );
            this.$menu.trigger( _e.closing );

            return 'close';
        },

        _init: function()
        {
            this.opts = extendOptions( this.opts, this.conf, this.$menu );
            this.direction = ( this.opts.slidingSubmenus ) ? 'horizontal' : 'vertical';

            //	INIT PAGE & MENU
            this._initPage( glbl.$page );
            this._initMenu();
            this._initBlocker();
            this._initPanles();
            this._initLinks();
            this._initOpenClose();
            this._bindCustomEvents();

            if ( $[ _PLUGIN_ ].addons )
            {
                for ( var a = 0; a < $[ _PLUGIN_ ].addons.length; a++ )
                {
                    if ( typeof this[ '_addon_' + $[ _PLUGIN_ ].addons[ a ] ] == 'function' )
                    {
                        this[ '_addon_' + $[ _PLUGIN_ ].addons[ a ] ]();
                    }
                }
            }
        },

        _bindCustomEvents: function()
        {
            var that = this;

            this.$menu
                .off( _e.open + ' ' + _e.close + ' ' + _e.setPage+ ' ' + _e.update )
                .on( _e.open + ' ' + _e.close + ' ' + _e.setPage+ ' ' + _e.update,
                    function( e )
                    {
                        e.stopPropagation();
                    }
                );

            //	Menu-events
            this.$menu
                .on( _e.open,
                    function( e )
                    {
                        if ( $(this).hasClass( _c.current ) )
                        {
                            e.stopImmediatePropagation();
                            return false;
                        }
                        return that.open();
                    }
                )
                .on( _e.close,
                    function( e )
                    {
                        if ( !$(this).hasClass( _c.current ) )
                        {
                            e.stopImmediatePropagation();
                            return false;
                        }
                        return that.close();
                    }
                )
                .on( _e.setPage,
                    function( e, $p )
                    {
                        that._initPage( $p );
                        that._initOpenClose();
                    }
                );

            //	Panel-events
            var $panels = this.$menu.find( this.opts.isMenu && this.direction != 'horizontal' ? 'ul, ol' : '.' + _c.panel );
            $panels
                .off( _e.toggle + ' ' + _e.open + ' ' + _e.close )
                .on( _e.toggle + ' ' + _e.open + ' ' + _e.close,
                    function( e )
                    {
                        e.stopPropagation();
                    }
                );

            if ( this.direction == 'horizontal' )
            {
                $panels
                    .on( _e.open,
                        function( e )
                        {
                            return openSubmenuHorizontal( $(this), that.$menu );
                        }
                    );
            }
            else
            {
                $panels
                    .on( _e.toggle,
                        function( e )
                        {
                            var $t = $(this);
                            return $t.triggerHandler( $t.parent().hasClass( _c.opened ) ? _e.close : _e.open );
                        }
                    )
                    .on( _e.open,
                        function( e )
                        {
                            $(this).parent().addClass( _c.opened );
                            return 'open';
                        }
                    )
                    .on( _e.close,
                        function( e )
                        {
                            $(this).parent().removeClass( _c.opened );
                            return 'close';
                        }
                    );
            }
        },

        _initBlocker: function()
        {
            var that = this;

            if ( !glbl.$blck )
            {
                glbl.$blck = $( '<div id="' + _c.blocker + '" />' )
                    .css( 'opacity', 0 )
                    .appendTo( glbl.$body );
            }

            glbl.$blck
                .off( _e.touchstart )
                .on( _e.touchstart,
                    function( e )
                    {
                        e.preventDefault();
                        e.stopPropagation();
                        glbl.$blck.trigger( _e.mousedown );
                    }
                )
                .on( _e.mousedown,
                    function( e )
                    {
                        e.preventDefault();
                        if ( !glbl.$html.hasClass( _c.modal ) )
                        {
                            that.$menu.trigger( _e.close );
                        }
                    }
                );
        },
        _initPage: function( $p )
        {
            if ( !$p )
            {
                $p = $(this.conf.pageSelector, glbl.$body);
                if ( $p.length > 1 )
                {
                    $[ _PLUGIN_ ].debug( 'Multiple nodes found for the page-node, all nodes are wrapped in one <' + this.conf.pageNodetype + '>.' );
                    $p = $p.wrapAll( '<' + this.conf.pageNodetype + ' />' ).parent();
                }
            }

            $p.addClass( _c.page );
            glbl.$page = $p;
        },
        _initMenu: function()
        {
            var that = this;

            //	Clone if needed
            if ( this.conf.clone )
            {
                this.$menu = this.$menu.clone( true );
                this.$menu.add( this.$menu.find( '*' ) ).filter( '[id]' ).each(
                    function()
                    {
                        $(this).attr( 'id', _c.mm( $(this).attr( 'id' ) ) );
                    }
                );
            }

            //	Strip whitespace
            this.$menu.contents().each(
                function()
                {
                    if ( $(this)[ 0 ].nodeType == 3 )
                    {
                        $(this).remove();
                    }
                }
            );

            //	Prepend to body
            this.$menu
                .prependTo( 'body' )
                .addClass( _c.menu );

            //	Add direction class
            this.$menu.addClass( _c.mm( this.direction ) );

            //	Add options classes
            if ( this.opts.classes )
            {
                this.$menu.addClass( this.opts.classes );
            }
            if ( this.opts.isMenu )
            {
                this.$menu.addClass( _c.ismenu );
            }
            if ( this.opts.position != 'left' )
            {
                this.$menu.addClass( _c.mm( this.opts.position ) );
            }
            if ( this.opts.zposition != 'back' )
            {
                this.$menu.addClass( _c.mm( this.opts.zposition ) );
            }
        },
        _initPanles: function()
        {
            var that = this;


            //	Refactor List class
            this.__refactorClass( $('.' + this.conf.listClass, this.$menu), 'list' );

            //	Add List class
            if ( this.opts.isMenu )
            {
                $('ul, ol', this.$menu)
                    .not( '.mm-nolist' )
                    .addClass( _c.list );
            }

            var $lis = $('.' + _c.list + ' > li', this.$menu);

            //	Refactor Selected class
            this.__refactorClass( $lis.filter( '.' + this.conf.selectedClass ), 'selected' );

            //	Refactor Label class
            this.__refactorClass( $lis.filter( '.' + this.conf.labelClass ), 'label' );

            //	Refactor Spacer class
            this.__refactorClass( $lis.filter( '.' + this.conf.spacerClass ), 'spacer' );

            //	setSelected-event
            $lis
                .off( _e.setSelected )
                .on( _e.setSelected,
                    function( e, selected )
                    {
                        e.stopPropagation();

                        $lis.removeClass( _c.selected );
                        if ( typeof selected != 'boolean' )
                        {
                            selected = true;
                        }
                        if ( selected )
                        {
                            $(this).addClass( _c.selected );
                        }
                    }
                );

            //	Refactor Panel class
            this.__refactorClass( $('.' + this.conf.panelClass, this.$menu), 'panel' );

            //	Add Panel class
            this.$menu
                .children()
                .filter( this.conf.panelNodetype )
                .add( this.$menu.find( '.' + _c.list ).children().children().filter( this.conf.panelNodetype ) )
                .addClass( _c.panel );

            var $panels = $('.' + _c.panel, this.$menu);

            //	Add an ID to all panels
            $panels
                .each(
                    function( i )
                    {
                        var $t = $(this),
                            id = $t.attr( 'id' ) || _c.mm( 'm' + that.serialnr + '-p' + i );

                        $t.attr( 'id', id );
                    }
                );

            //	Add open and close links to menu items
            $panels
                .find( '.' + _c.panel )
                .each(
                    function( i )
                    {
                        var $t = $(this),
                            $u = $t.is( 'ul, ol' ) ? $t : $t.find( 'ul ,ol' ).first(),
                            $l = $t.parent(),
                            $a = $l.find( '> a, > span' ),
                            $p = $l.closest( '.' + _c.panel );

                        $t.data( _d.parent, $l );

                        if ( $l.parent().is( '.' + _c.list ) )
                        {
                            var $btn = $( '<a class="' + _c.subopen + '" href="#' + $t.attr( 'id' ) + '" />' ).insertBefore( $a );
                            if ( !$a.is( 'a' ) )
                            {
                                $btn.addClass( _c.fullsubopen );
                            }
                            if ( that.direction == 'horizontal' )
                            {
                                $u.prepend( '<li class="' + _c.subtitle + '"><a class="' + _c.subclose + '" href="#' + $p.attr( 'id' ) + '">' + $a.text() + '</a></li>' );
                            }
                        }
                    }
                );

            //	Link anchors to panels
            var evt = this.direction == 'horizontal' ? _e.open : _e.toggle;
            $panels
                .each(
                    function( i )
                    {
                        var $opening = $(this),
                            id = $opening.attr( 'id' );

                        $('a[href="#' + id + '"]', that.$menu)
                            .off( _e.click )
                            .on( _e.click,
                                function( e )
                                {
                                    e.preventDefault();
                                    $opening.trigger( evt );
                                }
                            );
                    }
                );

            if ( this.direction == 'horizontal' )
            {
                //	Add opened-classes
                var $selected = $('.' + _c.list + ' > li.' + _c.selected, this.$menu);
                $selected
                    .add( $selected.parents( 'li' ) )
                    .parents( 'li' ).removeClass( _c.selected )
                    .end().each(
                    function()
                    {
                        var $t = $(this),
                            $u = $t.find( '> .' + _c.panel );

                        if ( $u.length )
                        {
                            $t.parents( '.' + _c.panel ).addClass( _c.subopened );
                            $u.addClass( _c.opened );
                        }
                    }
                )
                    .closest( '.' + _c.panel ).addClass( _c.opened )
                    .parents( '.' + _c.panel ).addClass( _c.subopened );
            }
            else
            {
                //	Replace Selected-class with opened-class in parents from .Selected
                $('li.' + _c.selected, this.$menu)
                    .addClass( _c.opened )
                    .parents( '.' + _c.selected ).removeClass( _c.selected );
            }

            //	Set current opened
            var $current = $panels.filter( '.' + _c.opened );
            if ( !$current.length )
            {
                $current = $panels.first();
            }
            $current
                .addClass( _c.opened )
                .last()
                .addClass( _c.current );

            //	Rearrange markup
            if ( this.direction == 'horizontal' )
            {
                $panels.find( '.' + _c.panel ).appendTo( this.$menu );
            }
        },
        _initLinks: function()
        {
            var that = this;

            $('.' + _c.list + ' > li > a', this.$menu)
                .not( '.' + _c.subopen )
                .not( '.' + _c.subclose )
                .not( '[rel="external"]' )
                .not( '[target="_blank"]' )
                .off( _e.click )
                .on( _e.click,
                    function( e )
                    {
                        var $t = $(this),
                            href = $t.attr( 'href' );

                        //	Set selected item
                        if ( that.__valueOrFn( that.opts.onClick.setSelected, $t ) )
                        {
                            $t.parent().trigger( _e.setSelected );
                        }

                        //	Prevent default / don't follow link. Default: false
                        var preventDefault = that.__valueOrFn( that.opts.onClick.preventDefault, $t, href.slice( 0, 1 ) == '#' );
                        if ( preventDefault )
                        {
                            e.preventDefault();
                        }

                        //	Block UI. Default: false if preventDefault, true otherwise
                        if ( that.__valueOrFn( that.opts.onClick.blockUI, $t, !preventDefault ) )
                        {
                            glbl.$html.addClass( _c.blocking );
                        }

                        //	Close menu. Default: true if preventDefault, false otherwise
                        if ( that.__valueOrFn( that.opts.onClick.close, $t, preventDefault ) )
                        {
                            that.$menu.triggerHandler( _e.close );
                        }
                    }
                );
        },
        _initOpenClose: function()
        {
            var that = this;

            //	Open menu
            var id = this.$menu.attr( 'id' );
            if ( id && id.length )
            {
                if ( this.conf.clone )
                {
                    id = _c.umm( id );
                }

                $('a[href="#' + id + '"]')
                    .off( _e.click )
                    .on( _e.click,
                        function( e )
                        {
                            e.preventDefault();
                            that.$menu.trigger( _e.open );
                        }
                    );
            }

            //	Close menu
            var id = glbl.$page.attr( 'id' );
            if ( id && id.length )
            {
                $('a[href="#' + id + '"]')
                    .off( _e.click )
                    .on( _e.click,
                        function( e )
                        {
                            e.preventDefault();
                            that.$menu.trigger( _e.close );
                        }
                    );
            }
        },

        __valueOrFn: function( o, $e, d )
        {
            if ( typeof o == 'function' )
            {
                return o.call( $e[ 0 ] );
            }
            if ( typeof o == 'undefined' && typeof d != 'undefined' )
            {
                return d;
            }
            return o;
        },

        __refactorClass: function( $e, c )
        {
            $e.removeClass( this.conf[ c + 'Class' ] ).addClass( _c[ c ] );
        }
    };


    $.fn[ _PLUGIN_ ] = function( opts, conf )
    {
        //	First time plugin is fired
        if ( !glbl.$wndw )
        {
            _initPlugin();
        }

        //	Extend options
        opts = extendOptions( opts, conf );
        conf = extendConfiguration( conf );

        return this.each(
            function()
            {
                var $menu = $(this);
                if ( $menu.data( _PLUGIN_ ) )
                {
                    return;
                }
                $menu.data( _PLUGIN_, new $[ _PLUGIN_ ]( $menu, opts, conf ) );
            }
        );
    };

    $[ _PLUGIN_ ].version = _VERSION_;

    $[ _PLUGIN_ ].defaults = {
        position		: 'left',
        zposition		: 'back',
        moveBackground	: true,
        slidingSubmenus	: true,
        modal			: false,
        classes			: '',
        onClick			: {
//			close				: true,
//			blockUI				: null,
//			preventDefault		: null,
            setSelected			: true
        }
    };
    $[ _PLUGIN_ ].configuration = {
        preventTabbing		: true,
        panelClass			: 'Panel',
        listClass			: 'List',
        selectedClass		: 'Selected',
        labelClass			: 'Label',
        spacerClass			: 'Spacer',
        pageNodetype		: 'div',
        panelNodetype		: 'ul, ol, div',
        transitionDuration	: 400
    };



    /*
        SUPPORT
    */
    (function() {

        var wd = window.document,
            ua = window.navigator.userAgent,
            ds = document.createElement( 'div' ).style;

        var _touch 				= 'ontouchstart' in wd,
            _overflowscrolling	= 'WebkitOverflowScrolling' in wd.documentElement.style,
            _oldAndroidBrowser	= (function() {
                if ( ua.indexOf( 'Android' ) >= 0 )
                {
                    return 2.4 > parseFloat( ua.slice( ua.indexOf( 'Android' ) +8 ) );
                }
                return false;
            })();

        $[ _PLUGIN_ ].support = {

            touch: _touch,
            oldAndroidBrowser: _oldAndroidBrowser,
            overflowscrolling: (function() {
                if ( !_touch )
                {
                    return true;
                }
                if ( _overflowscrolling )
                {
                    return true;
                }
                if ( _oldAndroidBrowser )
                {
                    return false;
                }
                return true;
            })()
        };
    })();


    /*
        BROWSER SPECIFIC FIXES
    */
    $[ _PLUGIN_ ].useOverflowScrollingFallback = function( use )
    {
        if ( glbl.$html )
        {
            if ( typeof use == 'boolean' )
            {
                glbl.$html[ use ? 'addClass' : 'removeClass' ]( _c.nooverflowscrolling );
            }
            return glbl.$html.hasClass( _c.nooverflowscrolling );
        }
        else
        {
            _useOverflowScrollingFallback = use;
            return use;
        }
    };


    /*
        DEBUG
    */
    $[ _PLUGIN_ ].debug = function( msg ) {};
    $[ _PLUGIN_ ].deprecated = function( depr, repl )
    {
        if ( typeof console != 'undefined' && typeof console.warn != 'undefined' )
        {
            console.warn( 'MMENU: ' + depr + ' is deprecated, use ' + repl + ' instead.' );
        }
    };


    //	Global vars
    var _useOverflowScrollingFallback = !$[ _PLUGIN_ ].support.overflowscrolling;


    function extendOptions( o, c, $m )
    {
        if ( typeof o != 'object' )
        {
            o = {};
        }

        if ( $m )
        {
            if ( typeof o.isMenu != 'boolean' )
            {
                var $c = $m.children();
                o.isMenu = ( $c.length == 1 && $c.is( c.panelNodetype ) );
            }
            return o;
        }


        //	Extend onClick
        if ( typeof o.onClick != 'object' )
        {
            o.onClick = {};
        }


        //	DEPRECATED
        if ( typeof o.onClick.setLocationHref != 'undefined' )
        {
            $[ _PLUGIN_ ].deprecated( 'onClick.setLocationHref option', '!onClick.preventDefault' );
            if ( typeof o.onClick.setLocationHref == 'boolean' )
            {
                o.onClick.preventDefault = !o.onClick.setLocationHref;
            }
        }
        //	/DEPRECATED


        //	Extend from defaults
        o = $.extend( true, {}, $[ _PLUGIN_ ].defaults, o );


        //	Degration
        if ( $[ _PLUGIN_ ].useOverflowScrollingFallback() )
        {
            switch( o.position )
            {
                case 'top':
                case 'right':
                case 'bottom':
                    $[ _PLUGIN_ ].debug( 'position: "' + o.position + '" not supported when using the overflowScrolling-fallback.' );
                    o.position = 'left';
                    break;
            }
            switch( o.zposition )
            {
                case 'front':
                case 'next':
                    $[ _PLUGIN_ ].debug( 'z-position: "' + o.zposition + '" not supported when using the overflowScrolling-fallback.' );
                    o.zposition = 'back';
                    break;
            }
        }

        return o;
    }
    function extendConfiguration( c )
    {
        if ( typeof c != 'object' )
        {
            c = {};
        }


        //	DEPRECATED
        if ( typeof c.panelNodeType != 'undefined' )
        {
            $[ _PLUGIN_ ].deprecated( 'panelNodeType configuration option', 'panelNodetype' );
            c.panelNodetype = c.panelNodeType;
        }
        //	/DEPRECATED


        c = $.extend( true, {}, $[ _PLUGIN_ ].configuration, c )

        //	Set pageSelector
        if ( typeof c.pageSelector != 'string' )
        {
            c.pageSelector = '> ' + c.pageNodetype;
        }

        return c;
    }

    function _initPlugin()
    {
        glbl.$wndw = $(window);
        glbl.$html = $('html');
        glbl.$body = $('body');

        glbl.$allMenus = $();


        //	Classnames, Datanames, Eventnames
        $.each( [ _c, _d, _e ],
            function( i, o )
            {
                o.add = function( c )
                {
                    c = c.split( ' ' );
                    for ( var d in c )
                    {
                        o[ c[ d ] ] = o.mm( c[ d ] );
                    }
                };
            }
        );

        //	Classnames
        _c.mm = function( c ) { return 'mm-' + c; };
        _c.add( 'menu ismenu panel list subtitle selected label spacer current highest hidden page blocker modal background opened opening subopened subopen fullsubopen subclose nooverflowscrolling' );
        _c.umm = function( c )
        {
            if ( c.slice( 0, 3 ) == 'mm-' )
            {
                c = c.slice( 3 );
            }
            return c;
        };

        //	Datanames
        _d.mm = function( d ) { return 'mm-' + d; };
        _d.add( 'parent style scrollTop offetLeft' );

        //	Eventnames
        _e.mm = function( e ) { return e + '.mm'; };
        _e.add( 'toggle open opening opened close closing closed update setPage setSelected transitionend webkitTransitionEnd touchstart touchend mousedown mouseup click keydown keyup resize' );


        $[ _PLUGIN_ ]._c = _c;
        $[ _PLUGIN_ ]._d = _d;
        $[ _PLUGIN_ ]._e = _e;

        $[ _PLUGIN_ ].glbl = glbl;

        $[ _PLUGIN_ ].useOverflowScrollingFallback( _useOverflowScrollingFallback );
    }

    function openSubmenuHorizontal( $opening, $m )
    {
        if ( $opening.hasClass( _c.current ) )
        {
            return false;
        }

        var $panels = $('.' + _c.panel, $m),
            $current = $panels.filter( '.' + _c.current );

        $panels
            .removeClass( _c.highest )
            .removeClass( _c.current )
            .not( $opening )
            .not( $current )
            .addClass( _c.hidden );

        if ( $opening.hasClass( _c.opened ) )
        {
            $current
                .addClass( _c.highest )
                .removeClass( _c.opened )
                .removeClass( _c.subopened );
        }
        else
        {
            $opening
                .addClass( _c.highest );

            $current
                .addClass( _c.subopened );
        }

        $opening
            .removeClass( _c.hidden )
            .removeClass( _c.subopened )
            .addClass( _c.current )
            .addClass( _c.opened );

        return 'open';
    }

    function findScrollTop()
    {
        if ( !glbl.$scrollTopNode )
        {
            if ( glbl.$html.scrollTop() != 0 )
            {
                glbl.$scrollTopNode = glbl.$html;
            }
            else if ( glbl.$body.scrollTop() != 0 )
            {
                glbl.$scrollTopNode = glbl.$body;
            }
        }
        return ( glbl.$scrollTopNode ) ? glbl.$scrollTopNode.scrollTop() : 0;
    }

    function transitionend( $e, fn, duration )
    {
        var _ended = false,
            _fn = function()
            {
                if ( !_ended )
                {
                    fn.call( $e[ 0 ] );
                }
                _ended = true;
            };

        $e.one( _e.transitionend, _fn );
        $e.one( _e.webkitTransitionEnd, _fn );
        setTimeout( _fn, duration * 1.1 );
    }

})( jQuery );

/*!
 * Bootstrap v3.3.1 (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){var b=a.fn.jquery.split(" ")[0].split(".");if(b[0]<2&&b[1]<9||1==b[0]&&9==b[1]&&b[2]<1)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")}(jQuery),+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){return a(b.target).is(this)?b.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.3.1",d.TRANSITION_DURATION=150,d.prototype.close=function(b){function c(){g.detach().trigger("closed.bs.alert").remove()}var e=a(this),f=e.attr("data-target");f||(f=e.attr("href"),f=f&&f.replace(/.*(?=#[^\s]*$)/,""));var g=a(f);b&&b.preventDefault(),g.length||(g=e.closest(".alert")),g.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(g.removeClass("in"),a.support.transition&&g.hasClass("fade")?g.one("bsTransitionEnd",c).emulateTransitionEnd(d.TRANSITION_DURATION):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.3.1",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),setTimeout(a.proxy(function(){d[e](null==f[b]?this.options[b]:f[b]),"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")&&(c.prop("checked")&&this.$element.hasClass("active")?a=!1:b.find(".active").removeClass("active")),a&&c.prop("checked",!this.$element.hasClass("active")).trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active"));a&&this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target);d.hasClass("btn")||(d=d.closest(".btn")),b.call(d,"toggle"),c.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(b){a(b.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(b.type))})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=this.sliding=this.interval=this.$active=this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",a.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.3.1",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(a){if(!/input|textarea/i.test(a.target.tagName)){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()}},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.getItemForDirection=function(a,b){var c="prev"==a?-1:1,d=this.getItemIndex(b),e=(d+c)%this.$items.length;return this.$items.eq(e)},c.prototype.to=function(a){var b=this,c=this.getItemIndex(this.$active=this.$element.find(".item.active"));return a>this.$items.length-1||0>a?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){b.to(a)}):c==a?this.pause().cycle():this.slide(a>c?"next":"prev",this.$items.eq(a))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){return this.sliding?void 0:this.slide("next")},c.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},c.prototype.slide=function(b,d){var e=this.$element.find(".item.active"),f=d||this.getItemForDirection(b,e),g=this.interval,h="next"==b?"left":"right",i="next"==b?"first":"last",j=this;if(!f.length){if(!this.options.wrap)return;f=this.$element.find(".item")[i]()}if(f.hasClass("active"))return this.sliding=!1;var k=f[0],l=a.Event("slide.bs.carousel",{relatedTarget:k,direction:h});if(this.$element.trigger(l),!l.isDefaultPrevented()){if(this.sliding=!0,g&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var m=a(this.$indicators.children()[this.getItemIndex(f)]);m&&m.addClass("active")}var n=a.Event("slid.bs.carousel",{relatedTarget:k,direction:h});return a.support.transition&&this.$element.hasClass("slide")?(f.addClass(b),f[0].offsetWidth,e.addClass(h),f.addClass(h),e.one("bsTransitionEnd",function(){f.removeClass([b,h].join(" ")).addClass("active"),e.removeClass(["active",h].join(" ")),j.sliding=!1,setTimeout(function(){j.$element.trigger(n)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(e.removeClass("active"),f.addClass("active"),this.sliding=!1,this.$element.trigger(n)),g&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this};var e=function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}};a(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){var c,d=b.attr("data-target")||(c=b.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"");return a(d)}function c(b){return this.each(function(){var c=a(this),e=c.data("bs.collapse"),f=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b);!e&&f.toggle&&"show"==b&&(f.toggle=!1),e||c.data("bs.collapse",e=new d(this,f)),"string"==typeof b&&e[b]()})}var d=function(b,c){this.$element=a(b),this.options=a.extend({},d.DEFAULTS,c),this.$trigger=a(this.options.trigger).filter('[href="#'+b.id+'"], [data-target="#'+b.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};d.VERSION="3.3.1",d.TRANSITION_DURATION=350,d.DEFAULTS={toggle:!0,trigger:'[data-toggle="collapse"]'},d.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},d.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b,e=this.$parent&&this.$parent.find("> .panel").children(".in, .collapsing");if(!(e&&e.length&&(b=e.data("bs.collapse"),b&&b.transitioning))){var f=a.Event("show.bs.collapse");if(this.$element.trigger(f),!f.isDefaultPrevented()){e&&e.length&&(c.call(e,"hide"),b||e.data("bs.collapse",null));var g=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var h=function(){this.$element.removeClass("collapsing").addClass("collapse in")[g](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return h.call(this);var i=a.camelCase(["scroll",g].join("-"));this.$element.one("bsTransitionEnd",a.proxy(h,this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])}}}},d.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var e=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(e,this)).emulateTransitionEnd(d.TRANSITION_DURATION):e.call(this)}}},d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},d.prototype.getParent=function(){return a(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(c,d){var e=a(d);this.addAriaAndCollapsedClass(b(e),e)},this)).end()},d.prototype.addAriaAndCollapsedClass=function(a,b){var c=a.hasClass("in");a.attr("aria-expanded",c),b.toggleClass("collapsed",!c).attr("aria-expanded",c)};var e=a.fn.collapse;a.fn.collapse=c,a.fn.collapse.Constructor=d,a.fn.collapse.noConflict=function(){return a.fn.collapse=e,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(d){var e=a(this);e.attr("data-target")||d.preventDefault();var f=b(e),g=f.data("bs.collapse"),h=g?"toggle":a.extend({},e.data(),{trigger:this});c.call(f,h)})}(jQuery),+function(a){"use strict";function b(b){b&&3===b.which||(a(e).remove(),a(f).each(function(){var d=a(this),e=c(d),f={relatedTarget:this};e.hasClass("open")&&(e.trigger(b=a.Event("hide.bs.dropdown",f)),b.isDefaultPrevented()||(d.attr("aria-expanded","false"),e.removeClass("open").trigger("hidden.bs.dropdown",f)))}))}function c(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.3.1",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=c(e),g=f.hasClass("open");if(b(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click",b);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),f.toggleClass("open").trigger("shown.bs.dropdown",h)}return!1}},g.prototype.keydown=function(b){if(/(38|40|27|32)/.test(b.which)&&!/input|textarea/i.test(b.target.tagName)){var d=a(this);if(b.preventDefault(),b.stopPropagation(),!d.is(".disabled, :disabled")){var e=c(d),g=e.hasClass("open");if(!g&&27!=b.which||g&&27==b.which)return 27==b.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.divider):visible a",i=e.find('[role="menu"]'+h+', [role="listbox"]'+h);if(i.length){var j=i.index(b.target);38==b.which&&j>0&&j--,40==b.which&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",b).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f,g.prototype.keydown).on("keydown.bs.dropdown.data-api",'[role="menu"]',g.prototype.keydown).on("keydown.bs.dropdown.data-api",'[role="listbox"]',g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$backdrop=this.isShown=null,this.scrollbarWidth=0,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.3.1",c.TRANSITION_DURATION=300,c.BACKDROP_TRANSITION_DURATION=150,c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var d=this,e=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(e),this.isShown||e.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.backdrop(function(){var e=a.support.transition&&d.$element.hasClass("fade");d.$element.parent().length||d.$element.appendTo(d.$body),d.$element.show().scrollTop(0),d.options.backdrop&&d.adjustBackdrop(),d.adjustDialog(),e&&d.$element[0].offsetWidth,d.$element.addClass("in").attr("aria-hidden",!1),d.enforceFocus();var f=a.Event("shown.bs.modal",{relatedTarget:b});e?d.$element.find(".modal-dialog").one("bsTransitionEnd",function(){d.$element.trigger("focus").trigger(f)}).emulateTransitionEnd(c.TRANSITION_DURATION):d.$element.trigger("focus").trigger(f)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").attr("aria-hidden",!0).off("click.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(c.TRANSITION_DURATION):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},c.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$body.removeClass("modal-open"),a.resetAdjustments(),a.resetScrollbar(),a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var d=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var f=a.support.transition&&e;if(this.$backdrop=a('<div class="modal-backdrop '+e+'" />').prependTo(this.$element).on("click.dismiss.bs.modal",a.proxy(function(a){a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus.call(this.$element[0]):this.hide.call(this))},this)),f&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;f?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var g=function(){d.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):g()}else b&&b()},c.prototype.handleUpdate=function(){this.options.backdrop&&this.adjustBackdrop(),this.adjustDialog()},c.prototype.adjustBackdrop=function(){this.$backdrop.css("height",0).css("height",this.$element[0].scrollHeight)},c.prototype.adjustDialog=function(){var a=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&a?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!a?this.scrollbarWidth:""})},c.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},c.prototype.checkScrollbar=function(){this.bodyIsOverflowing=document.body.scrollHeight>document.documentElement.clientHeight,this.scrollbarWidth=this.measureScrollbar()},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.bodyIsOverflowing&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right","")},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b,g=f&&f.selector;(e||"destroy"!=b)&&(g?(e||d.data("bs.tooltip",e={}),e[g]||(e[g]=new c(this,f))):e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=this.options=this.enabled=this.timeout=this.hoverState=this.$element=null,this.init("tooltip",a,b)};c.VERSION="3.3.1",c.TRANSITION_DURATION=150,c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(this.options.viewport.selector||this.options.viewport);for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c&&c.$tip&&c.$tip.is(":visible")?void(c.hoverState="in"):(c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show())},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide()},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var d=a.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!d)return;var e=this,f=this.tip(),g=this.getUID(this.type);this.setContent(),f.attr("id",g),this.$element.attr("aria-describedby",g),this.options.animation&&f.addClass("fade");var h="function"==typeof this.options.placement?this.options.placement.call(this,f[0],this.$element[0]):this.options.placement,i=/\s?auto?\s?/i,j=i.test(h);j&&(h=h.replace(i,"")||"top"),f.detach().css({top:0,left:0,display:"block"}).addClass(h).data("bs."+this.type,this),this.options.container?f.appendTo(this.options.container):f.insertAfter(this.$element);var k=this.getPosition(),l=f[0].offsetWidth,m=f[0].offsetHeight;if(j){var n=h,o=this.options.container?a(this.options.container):this.$element.parent(),p=this.getPosition(o);h="bottom"==h&&k.bottom+m>p.bottom?"top":"top"==h&&k.top-m<p.top?"bottom":"right"==h&&k.right+l>p.width?"left":"left"==h&&k.left-l<p.left?"right":h,f.removeClass(n).addClass(h)}var q=this.getCalculatedOffset(h,k,l,m);this.applyPlacement(q,h);var r=function(){var a=e.hoverState;e.$element.trigger("shown.bs."+e.type),e.hoverState=null,"out"==a&&e.leave(e)};a.support.transition&&this.$tip.hasClass("fade")?f.one("bsTransitionEnd",r).emulateTransitionEnd(c.TRANSITION_DURATION):r()}},c.prototype.applyPlacement=function(b,c){var d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),b.top=b.top+g,b.left=b.left+h,a.offset.setOffset(d[0],a.extend({using:function(a){d.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),d.addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;"top"==c&&j!=f&&(b.top=b.top+f-j);var k=this.getViewportAdjustedDelta(c,b,i,j);k.left?b.left+=k.left:b.top+=k.top;var l=/top|bottom/.test(c),m=l?2*k.left-e+i:2*k.top-f+j,n=l?"offsetWidth":"offsetHeight";d.offset(b),this.replaceArrow(m,d[0][n],l)},c.prototype.replaceArrow=function(a,b,c){this.arrow().css(c?"left":"top",50*(1-a/b)+"%").css(c?"top":"left","")},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},c.prototype.hide=function(b){function d(){"in"!=e.hoverState&&f.detach(),e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),b&&b()}var e=this,f=this.tip(),g=a.Event("hide.bs."+this.type);return this.$element.trigger(g),g.isDefaultPrevented()?void 0:(f.removeClass("in"),a.support.transition&&this.$tip.hasClass("fade")?f.one("bsTransitionEnd",d).emulateTransitionEnd(c.TRANSITION_DURATION):d(),this.hoverState=null,this)},c.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},c.prototype.hasContent=function(){return this.getTitle()},c.prototype.getPosition=function(b){b=b||this.$element;var c=b[0],d="BODY"==c.tagName,e=c.getBoundingClientRect();null==e.width&&(e=a.extend({},e,{width:e.right-e.left,height:e.bottom-e.top}));var f=d?{top:0,left:0}:b.offset(),g={scroll:d?document.documentElement.scrollTop||document.body.scrollTop:b.scrollTop()},h=d?{width:a(window).width(),height:a(window).height()}:null;return a.extend({},e,g,h,f)},c.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},c.prototype.getViewportAdjustedDelta=function(a,b,c,d){var e={top:0,left:0};if(!this.$viewport)return e;var f=this.options.viewport&&this.options.viewport.padding||0,g=this.getPosition(this.$viewport);if(/right|left/.test(a)){var h=b.top-f-g.scroll,i=b.top+f-g.scroll+d;h<g.top?e.top=g.top-h:i>g.top+g.height&&(e.top=g.top+g.height-i)}else{var j=b.left-f,k=b.left+f+c;j<g.left?e.left=g.left-j:k>g.width&&(e.left=g.left+g.width-k)}return e},c.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},c.prototype.getUID=function(a){do a+=~~(1e6*Math.random());while(document.getElementById(a));return a},c.prototype.tip=function(){return this.$tip=this.$tip||a(this.options.template)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},c.prototype.enable=function(){this.enabled=!0},c.prototype.disable=function(){this.enabled=!1},c.prototype.toggleEnabled=function(){this.enabled=!this.enabled},c.prototype.toggle=function(b){var c=this;b&&(c=a(b.currentTarget).data("bs."+this.type),c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c))),c.tip().hasClass("in")?c.leave(c):c.enter(c)},c.prototype.destroy=function(){var a=this;clearTimeout(this.timeout),this.hide(function(){a.$element.off("."+a.type).removeData("bs."+a.type)})};var d=a.fn.tooltip;a.fn.tooltip=b,a.fn.tooltip.Constructor=c,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=d,this}}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof b&&b,g=f&&f.selector;(e||"destroy"!=b)&&(g?(e||d.data("bs.popover",e={}),e[g]||(e[g]=new c(this,f))):e||d.data("bs.popover",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");c.VERSION="3.3.1",c.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),c.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),c.prototype.constructor=c,c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content").children().detach().end()[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},c.prototype.hasContent=function(){return this.getTitle()||this.getContent()},c.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")},c.prototype.tip=function(){return this.$tip||(this.$tip=a(this.options.template)),this.$tip};var d=a.fn.popover;a.fn.popover=b,a.fn.popover.Constructor=c,a.fn.popover.noConflict=function(){return a.fn.popover=d,this}}(jQuery),+function(a){"use strict";function b(c,d){var e=a.proxy(this.process,this);this.$body=a("body"),this.$scrollElement=a(a(c).is("body")?window:c),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",e),this.refresh(),this.process()}function c(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})}b.VERSION="3.3.1",b.DEFAULTS={offset:10},b.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},b.prototype.refresh=function(){var b="offset",c=0;a.isWindow(this.$scrollElement[0])||(b="position",c=this.$scrollElement.scrollTop()),this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight();var d=this;this.$body.find(this.selector).map(function(){var d=a(this),e=d.data("target")||d.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[b]().top+c,e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){d.offsets.push(this[0]),d.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.getScrollHeight(),d=this.options.offset+c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(this.scrollHeight!=c&&this.refresh(),b>=d)return g!=(a=f[f.length-1])&&this.activate(a);if(g&&b<e[0])return this.activeTarget=null,this.clear();for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(!e[a+1]||b<=e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,this.clear();var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate.bs.scrollspy")},b.prototype.clear=function(){a(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var d=a.fn.scrollspy;a.fn.scrollspy=c,a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=d,this},a(window).on("load.bs.scrollspy.data-api",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new c(this)),"string"==typeof b&&e[b]()})}var c=function(b){this.element=a(b)};c.VERSION="3.3.1",c.TRANSITION_DURATION=150,c.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a"),f=a.Event("hide.bs.tab",{relatedTarget:b[0]}),g=a.Event("show.bs.tab",{relatedTarget:e[0]});if(e.trigger(f),b.trigger(g),!g.isDefaultPrevented()&&!f.isDefaultPrevented()){var h=a(d);this.activate(b.closest("li"),c),this.activate(h,h.parent(),function(){e.trigger({type:"hidden.bs.tab",relatedTarget:b[0]}),b.trigger({type:"shown.bs.tab",relatedTarget:e[0]})
})}}},c.prototype.activate=function(b,d,e){function f(){g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),h?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu")&&b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),e&&e()}var g=d.find("> .active"),h=e&&a.support.transition&&(g.length&&g.hasClass("fade")||!!d.find("> .fade").length);g.length&&h?g.one("bsTransitionEnd",f).emulateTransitionEnd(c.TRANSITION_DURATION):f(),g.removeClass("in")};var d=a.fn.tab;a.fn.tab=b,a.fn.tab.Constructor=c,a.fn.tab.noConflict=function(){return a.fn.tab=d,this};var e=function(c){c.preventDefault(),b.call(a(this),"show")};a(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',e).on("click.bs.tab.data-api",'[data-toggle="pill"]',e)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof b&&b;e||d.data("bs.affix",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.options=a.extend({},c.DEFAULTS,d),this.$target=a(this.options.target).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(b),this.affixed=this.unpin=this.pinnedOffset=null,this.checkPosition()};c.VERSION="3.3.1",c.RESET="affix affix-top affix-bottom",c.DEFAULTS={offset:0,target:window},c.prototype.getState=function(a,b,c,d){var e=this.$target.scrollTop(),f=this.$element.offset(),g=this.$target.height();if(null!=c&&"top"==this.affixed)return c>e?"top":!1;if("bottom"==this.affixed)return null!=c?e+this.unpin<=f.top?!1:"bottom":a-d>=e+g?!1:"bottom";var h=null==this.affixed,i=h?e:f.top,j=h?g:b;return null!=c&&c>=i?"top":null!=d&&i+j>=a-d?"bottom":!1},c.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a=this.$target.scrollTop(),b=this.$element.offset();return this.pinnedOffset=b.top-a},c.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},c.prototype.checkPosition=function(){if(this.$element.is(":visible")){var b=this.$element.height(),d=this.options.offset,e=d.top,f=d.bottom,g=a("body").height();"object"!=typeof d&&(f=e=d),"function"==typeof e&&(e=d.top(this.$element)),"function"==typeof f&&(f=d.bottom(this.$element));var h=this.getState(g,b,e,f);if(this.affixed!=h){null!=this.unpin&&this.$element.css("top","");var i="affix"+(h?"-"+h:""),j=a.Event(i+".bs.affix");if(this.$element.trigger(j),j.isDefaultPrevented())return;this.affixed=h,this.unpin="bottom"==h?this.getPinnedOffset():null,this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix","affixed")+".bs.affix")}"bottom"==h&&this.$element.offset({top:g-b-f})}};var d=a.fn.affix;a.fn.affix=b,a.fn.affix.Constructor=c,a.fn.affix.noConflict=function(){return a.fn.affix=d,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var c=a(this),d=c.data();d.offset=d.offset||{},null!=d.offsetBottom&&(d.offset.bottom=d.offsetBottom),null!=d.offsetTop&&(d.offset.top=d.offsetTop),b.call(c,d)})})}(jQuery);

/*!

Holder - client side image placeholders
Version 2.4.1+f2l1h
Â© 2014 Ivan Malopinsky - http://imsky.co

Site:     http://imsky.github.io/holder
Issues:   https://github.com/imsky/holder/issues
License:  http://opensource.org/licenses/MIT

*/
!function(a,b,c){b[a]=c}("onDomReady",this,function(a){"use strict";function b(a){if(!v){if(!g.body)return e(b);for(v=!0;a=w.shift();)e(a)}}function c(a){(t||a.type===i||g[m]===l)&&(d(),b())}function d(){t?(g[s](q,c,j),a[s](i,c,j)):(g[o](r,c),a[o](k,c))}function e(a,b){setTimeout(a,+b>=0?b:1)}function f(a){v?e(a):w.push(a)}null==document.readyState&&document.addEventListener&&(document.addEventListener("DOMContentLoaded",function y(){document.removeEventListener("DOMContentLoaded",y,!1),document.readyState="complete"},!1),document.readyState="loading");var g=a.document,h=g.documentElement,i="load",j=!1,k="on"+i,l="complete",m="readyState",n="attachEvent",o="detachEvent",p="addEventListener",q="DOMContentLoaded",r="onreadystatechange",s="removeEventListener",t=p in g,u=j,v=j,w=[];if(g[m]===l)e(b);else if(t)g[p](q,c,j),a[p](i,c,j);else{g[n](r,c),a[n](k,c);try{u=null==a.frameElement&&h}catch(x){}u&&u.doScroll&&!function z(){if(!v){try{u.doScroll("left")}catch(a){return e(z,50)}d(),b()}}()}return f.version="1.4.0",f.isReady=function(){return v},f}(this)),document.querySelectorAll||(document.querySelectorAll=function(a){var b,c=document.createElement("style"),d=[];for(document.documentElement.firstChild.appendChild(c),document._qsa=[],c.styleSheet.cssText=a+"{x-qsa:expression(document._qsa && document._qsa.push(this))}",window.scrollBy(0,0),c.parentNode.removeChild(c);document._qsa.length;)b=document._qsa.shift(),b.style.removeAttribute("x-qsa"),d.push(b);return document._qsa=null,d}),document.querySelector||(document.querySelector=function(a){var b=document.querySelectorAll(a);return b.length?b[0]:null}),document.getElementsByClassName||(document.getElementsByClassName=function(a){return a=String(a).replace(/^|\s+/g,"."),document.querySelectorAll(a)}),Object.keys||(Object.keys=function(a){if(a!==Object(a))throw TypeError("Object.keys called on non-object");var b,c=[];for(b in a)Object.prototype.hasOwnProperty.call(a,b)&&c.push(b);return c}),function(a){var b="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";a.atob=a.atob||function(a){a=String(a);var c,d=0,e=[],f=0,g=0;if(a=a.replace(/\s/g,""),a.length%4===0&&(a=a.replace(/=+$/,"")),a.length%4===1)throw Error("InvalidCharacterError");if(/[^+/0-9A-Za-z]/.test(a))throw Error("InvalidCharacterError");for(;d<a.length;)c=b.indexOf(a.charAt(d)),f=f<<6|c,g+=6,24===g&&(e.push(String.fromCharCode(f>>16&255)),e.push(String.fromCharCode(f>>8&255)),e.push(String.fromCharCode(255&f)),g=0,f=0),d+=1;return 12===g?(f>>=4,e.push(String.fromCharCode(255&f))):18===g&&(f>>=2,e.push(String.fromCharCode(f>>8&255)),e.push(String.fromCharCode(255&f))),e.join("")},a.btoa=a.btoa||function(a){a=String(a);var c,d,e,f,g,h,i,j=0,k=[];if(/[^\x00-\xFF]/.test(a))throw Error("InvalidCharacterError");for(;j<a.length;)c=a.charCodeAt(j++),d=a.charCodeAt(j++),e=a.charCodeAt(j++),f=c>>2,g=(3&c)<<4|d>>4,h=(15&d)<<2|e>>6,i=63&e,j===a.length+2?(h=64,i=64):j===a.length+1&&(i=64),k.push(b.charAt(f),b.charAt(g),b.charAt(h),b.charAt(i));return k.join("")}}(this),function(){function a(b,c,d){b.document;var e,f=b.currentStyle[c].match(/([\d\.]+)(%|cm|em|in|mm|pc|pt|)/)||[0,0,""],g=f[1],h=f[2];return d=d?/%|em/.test(h)&&b.parentElement?a(b.parentElement,"fontSize",null):16:d,e="fontSize"==c?d:/width/i.test(c)?b.clientWidth:b.clientHeight,"%"==h?g/100*e:"cm"==h?.3937*g*96:"em"==h?g*d:"in"==h?96*g:"mm"==h?.3937*g*96/10:"pc"==h?12*g*96/72:"pt"==h?96*g/72:g}function b(a,b){var c="border"==b?"Width":"",d=b+"Top"+c,e=b+"Right"+c,f=b+"Bottom"+c,g=b+"Left"+c;a[b]=(a[d]==a[e]&&a[d]==a[f]&&a[d]==a[g]?[a[d]]:a[d]==a[f]&&a[g]==a[e]?[a[d],a[e]]:a[g]==a[e]?[a[d],a[e],a[f]]:[a[d],a[e],a[f],a[g]]).join(" ")}function c(c){var d,e=this,f=c.currentStyle,g=a(c,"fontSize"),h=function(a){return"-"+a.toLowerCase()};for(d in f)if(Array.prototype.push.call(e,"styleFloat"==d?"float":d.replace(/[A-Z]/,h)),"width"==d)e[d]=c.offsetWidth+"px";else if("height"==d)e[d]=c.offsetHeight+"px";else if("styleFloat"==d)e.float=f[d];else if(/margin.|padding.|border.+W/.test(d)&&"auto"!=e[d])e[d]=Math.round(a(c,d,g))+"px";else if(/^outline/.test(d))try{e[d]=f[d]}catch(i){e.outlineColor=f.color,e.outlineStyle=e.outlineStyle||"none",e.outlineWidth=e.outlineWidth||"0px",e.outline=[e.outlineColor,e.outlineWidth,e.outlineStyle].join(" ")}else e[d]=f[d];b(e,"margin"),b(e,"padding"),b(e,"border"),e.fontSize=Math.round(g)+"px"}window.getComputedStyle||(c.prototype={constructor:c,getPropertyPriority:function(){throw new Error("NotSupportedError: DOM Exception 9")},getPropertyValue:function(a){var b=a.replace(/-([a-z])/g,function(a){return a=a.charAt?a.split(""):a,a[1].toUpperCase()}),c=this[b];return c},item:function(a){return this[a]},removeProperty:function(){throw new Error("NoModificationAllowedError: DOM Exception 7")},setProperty:function(){throw new Error("NoModificationAllowedError: DOM Exception 7")},getPropertyCSSValue:function(){throw new Error("NotSupportedError: DOM Exception 9")}},window.getComputedStyle=function(a){return new c(a)})}(),Object.prototype.hasOwnProperty||(Object.prototype.hasOwnProperty=function(a){var b=this.__proto__||this.constructor.prototype;return a in this&&(!(a in b)||b[a]!==this[a])}),function(a,b){a.augment=b()}(this,function(){"use strict";var a=function(){},b=Array.prototype.slice,c=function(c,d){var e=a.prototype="function"==typeof c?c.prototype:c,f=new a,g=d.apply(f,b.call(arguments,2).concat(e));if("object"==typeof g)for(var h in g)f[h]=g[h];if(!f.hasOwnProperty("constructor"))return f;var i=f.constructor;return i.prototype=f,i};return c.defclass=function(a){var b=a.constructor;return b.prototype=a,b},c.extend=function(a,b){return c(a,function(a){return this.uber=a,b})},c}),function(a,b){function c(a,b,c,f){var g=d(c.substr(c.lastIndexOf(a.domain)),a);g&&e(null,f,g,b)}function d(a,b){for(var c={theme:p(A.settings.themes.gray,null),stylesheets:b.stylesheets,holderURL:[]},d=!1,e=String.fromCharCode(11),f=a.replace(/([^\\])\//g,"$1"+e).split(e),g=/%[0-9a-f]{2}/gi,h=f.length,i=0;h>i;i++){var j=f[i];if(j.match(g))try{j=decodeURIComponent(j)}catch(k){j=f[i]}var l=!1;if(A.flags.dimensions.match(j))d=!0,c.dimensions=A.flags.dimensions.output(j),l=!0;else if(A.flags.fluid.match(j))d=!0,c.dimensions=A.flags.fluid.output(j),c.fluid=!0,l=!0;else if(A.flags.textmode.match(j))c.textmode=A.flags.textmode.output(j),l=!0;else if(A.flags.colors.match(j)){var m=A.flags.colors.output(j);c.theme=p(c.theme,m),l=!0}else if(b.themes[j])b.themes.hasOwnProperty(j)&&(c.theme=p(b.themes[j],null)),l=!0;else if(A.flags.font.match(j))c.font=A.flags.font.output(j),l=!0;else if(A.flags.auto.match(j))c.auto=!0,l=!0;else if(A.flags.text.match(j))c.text=A.flags.text.output(j),l=!0;else if(A.flags.random.match(j)){null==A.vars.cache.themeKeys&&(A.vars.cache.themeKeys=Object.keys(b.themes));var n=A.vars.cache.themeKeys[0|Math.random()*A.vars.cache.themeKeys.length];c.theme=p(b.themes[n],null),l=!0}l&&c.holderURL.push(j)}return c.holderURL.unshift(b.domain),c.holderURL=c.holderURL.join("/"),d?c:!1}function e(a,b,c,d){var e=c.dimensions,g=c.theme,h=e.width+"x"+e.height;if(a=null==a?c.fluid?"fluid":"image":a,null!=c.text&&(g.text=c.text,"object"===b.nodeName.toLowerCase())){for(var j=g.text.split("\\n"),l=0;l<j.length;l++)j[l]=v(j[l]);g.text=j.join("\\n")}var n=c.holderURL,o=p(d,null);c.font&&(g.font=c.font,!o.noFontFallback&&"img"===b.nodeName.toLowerCase()&&A.setup.supportsCanvas&&"svg"===o.renderer&&(o=p(o,{renderer:"canvas"}))),c.font&&"canvas"==o.renderer&&(o.reRender=!0),"background"==a?null==b.getAttribute("data-background-src")&&m(b,{"data-background-src":n}):m(b,{"data-src":n}),c.theme=g,b.holderData={flags:c,renderSettings:o},("image"==a||"fluid"==a)&&m(b,{alt:g.text?(g.text.length>16?g.text.substring(0,16)+"â€¦":g.text)+" ["+h+"]":h}),"image"==a?("html"!=o.renderer&&c.auto||(b.style.width=e.width+"px",b.style.height=e.height+"px"),"html"==o.renderer?b.style.backgroundColor=g.background:(f(a,{dimensions:e,theme:g,flags:c},b,o),c.textmode&&"exact"==c.textmode&&(A.vars.resizableImages.push(b),i(b)))):"background"==a&&"html"!=o.renderer?f(a,{dimensions:e,theme:g,flags:c},b,o):"fluid"==a&&("%"==e.height.slice(-1)?b.style.height=e.height:null!=c.auto&&c.auto||(b.style.height=e.height+"px"),"%"==e.width.slice(-1)?b.style.width=e.width:null!=c.auto&&c.auto||(b.style.width=e.width+"px"),("inline"==b.style.display||""===b.style.display||"none"==b.style.display)&&(b.style.display="block"),k(b),"html"==o.renderer?b.style.backgroundColor=g.background:(A.vars.resizableImages.push(b),i(b)))}function f(a,b,c,d){function e(){var a=null;switch(d.renderer){case"canvas":a=C(i);break;case"svg":a=D(i,d);break;default:throw"Holder: invalid renderer: "+d.renderer}return a}var f=null;switch(d.renderer){case"svg":if(!A.setup.supportsSVG)return;break;case"canvas":if(!A.setup.supportsCanvas)return;break;default:return}var h={width:b.dimensions.width,height:b.dimensions.height,theme:b.theme,flags:b.flags},i=g(h);if({text:h.text,width:h.width,height:h.height,textHeight:h.font.size,font:h.font.family,fontWeight:h.font.weight,template:h.theme},f=e(),null==f)throw"Holder: couldn't render placeholder";"background"==a?(c.style.backgroundImage="url("+f+")",c.style.backgroundSize=h.width+"px "+h.height+"px"):("img"===c.nodeName.toLowerCase()?m(c,{src:f}):"object"===c.nodeName.toLowerCase()&&(m(c,{data:f}),m(c,{type:"image/svg+xml"})),d.reRender&&setTimeout(function(){var a=e();if(null==a)throw"Holder: couldn't render placeholder";"img"===c.nodeName.toLowerCase()?m(c,{src:a}):"object"===c.nodeName.toLowerCase()&&(m(c,{data:a}),m(c,{type:"image/svg+xml"}))},100)),m(c,{"data-holder-rendered":!0})}function g(a){function b(a,b,c,d){b.width=c,b.height=d,a.width=Math.max(a.width,b.width),a.height+=b.height,a.add(b)}switch(a.font={family:a.theme.font?a.theme.font:"Arial, Helvetica, Open Sans, sans-serif",size:h(a.width,a.height,a.theme.size?a.theme.size:A.defaults.size),units:a.theme.units?a.theme.units:A.defaults.units,weight:a.theme.fontweight?a.theme.fontweight:"bold"},a.text=a.theme.text?a.theme.text:Math.floor(a.width)+"x"+Math.floor(a.height),a.flags.textmode){case"literal":a.text=a.flags.dimensions.width+"x"+a.flags.dimensions.height;break;case"exact":if(!a.flags.exactDimensions)break;a.text=Math.floor(a.flags.exactDimensions.width)+"x"+Math.floor(a.flags.exactDimensions.height)}var c=new E({width:a.width,height:a.height}),d=c.Shape,e=new d.Rect("holderBg",{fill:a.theme.background});e.resize(a.width,a.height),c.root.add(e);var f=new d.Group("holderTextGroup",{text:a.text,align:"center",font:a.font,fill:a.theme.foreground});f.moveTo(null,null,1),c.root.add(f);var g=f.textPositionData=B(c);if(!g)throw"Holder: staging fallback not supported yet.";f.properties.leading=g.boundingBox.height;var i=null,j=null;if(g.lineCount>1){var k=0,l=0,m=a.width*A.setup.lineWrapRatio,n=0;j=new d.Group("line"+n);for(var o=0;o<g.words.length;o++){var p=g.words[o];i=new d.Text(p.text);var q="\\n"==p.text;(k+p.width>=m||q===!0)&&(b(f,j,k,f.properties.leading),k=0,l+=f.properties.leading,n+=1,j=new d.Group("line"+n),j.y=l),q!==!0&&(i.moveTo(k,0),k+=g.spaceWidth+p.width,j.add(i))}b(f,j,k,f.properties.leading);for(var r in f.children)j=f.children[r],j.moveTo((f.width-j.width)/2,null,null);f.moveTo((a.width-f.width)/2,(a.height-f.height)/2,null),(a.height-f.height)/2<0&&f.moveTo(null,0,null)}else i=new d.Text(a.text),j=new d.Group("line0"),j.add(i),f.add(j),f.moveTo((a.width-g.boundingBox.width)/2,(a.height-g.boundingBox.height)/2,null);return c}function h(a,b,c){b=parseInt(b,10),a=parseInt(a,10);var d=Math.max(b,a),e=Math.min(b,a),f=A.defaults.scale,g=Math.min(.75*e,.75*d*f);return Math.round(Math.max(c,g))}function i(a){var b;b=null==a||null==a.nodeType?A.vars.resizableImages:[a];for(var c in b)if(b.hasOwnProperty(c)){var d=b[c];if(d.holderData){var e=d.holderData.flags,g=j(d,z.invisibleErrorFn(i));if(g){if(e.fluid&&e.auto){var h=d.holderData.fluidConfig;switch(h.mode){case"width":g.height=g.width/h.ratio;break;case"height":g.width=g.height*h.ratio}}var k={dimensions:g,theme:e.theme,flags:e};e.textmode&&"exact"==e.textmode&&(e.exactDimensions=g,k.dimensions=e.dimensions),f("image",k,d,d.holderData.renderSettings)}}}}function j(a,b){var c={height:a.clientHeight,width:a.clientWidth};return c.height||c.width?(a.removeAttribute("data-holder-invisible"),c):(m(a,{"data-holder-invisible":!0}),void b.call(this,a))}function k(a){if(a.holderData){var b=j(a,z.invisibleErrorFn(k));if(b){var c=a.holderData.flags,d={fluidHeight:"%"==c.dimensions.height.slice(-1),fluidWidth:"%"==c.dimensions.width.slice(-1),mode:null,initialDimensions:b};d.fluidWidth&&!d.fluidHeight?(d.mode="width",d.ratio=d.initialDimensions.width/parseFloat(c.dimensions.height)):!d.fluidWidth&&d.fluidHeight&&(d.mode="height",d.ratio=parseFloat(c.dimensions.width)/d.initialDimensions.height),a.holderData.fluidConfig=d}}}function l(a,b){return null==b?y.createElement(a):y.createElementNS(b,a)}function m(a,b){for(var c in b)a.setAttribute(c,b[c])}function n(a,b,c){if(null==a){a=l("svg",x);var d=l("defs",x);a.appendChild(d)}return a.webkitMatchesSelector&&a.setAttribute("xmlns",x),m(a,{width:b,height:c,viewBox:"0 0 "+b+" "+c,preserveAspectRatio:"none"}),a}function o(a,c){if(b.XMLSerializer){var d=new XMLSerializer,e="",f=c.stylesheets;if(a.querySelector("defs"),c.svgXMLStylesheet){for(var g=(new DOMParser).parseFromString("<xml />","application/xml"),h=f.length-1;h>=0;h--){var i=g.createProcessingInstruction("xml-stylesheet",'href="'+f[h]+'" rel="stylesheet"');g.insertBefore(i,g.firstChild)}var j=g.createProcessingInstruction("xml",'version="1.0" encoding="UTF-8" standalone="yes"');g.insertBefore(j,g.firstChild),g.removeChild(g.documentElement),e=d.serializeToString(g)}var k=d.serializeToString(a);return k=k.replace(/\&amp;(\#[0-9]{2,}\;)/g,"&$1"),e+k}}function p(a,b){var c={};for(var d in a)a.hasOwnProperty(d)&&(c[d]=a[d]);if(null!=b)for(var e in b)b.hasOwnProperty(e)&&(c[e]=b[e]);return c}function q(a){var b=[];for(var c in a)a.hasOwnProperty(c)&&b.push(c+":"+a[c]);return b.join(";")}function r(a){A.vars.debounceTimer||a.call(this),A.vars.debounceTimer&&clearTimeout(A.vars.debounceTimer),A.vars.debounceTimer=setTimeout(function(){A.vars.debounceTimer=null,a.call(this)},A.setup.debounce)}function s(){r(function(){i(null)})}function t(a){var c=null;return"string"==typeof a?c=y.querySelectorAll(a):b.NodeList&&a instanceof b.NodeList?c=a:b.Node&&a instanceof b.Node?c=[a]:b.HTMLCollection&&a instanceof b.HTMLCollection?c=a:null===a&&(c=[]),c}function u(a,b){var c=new Image;c.onerror=function(){b.call(this,!1)},c.onload=function(){b.call(this,!0)},c.src=a}function v(a){for(var b=[],c=0,d=a.length-1;d>=0;d--)c=a.charCodeAt(d),b.unshift(c>128?["&#",c,";"].join(""):a[d]);return b.join("")}function w(a){return a.replace(/&#(\d+);/g,function(a,b){return String.fromCharCode(b)})}var x="http://www.w3.org/2000/svg",y=b.document,z={addTheme:function(a,b){return null!=a&&null!=b&&(A.settings.themes[a]=b),delete A.vars.cache.themeKeys,this},addImage:function(a,b){var c=y.querySelectorAll(b);if(c.length)for(var d=0,e=c.length;e>d;d++){var f=l("img");m(f,{"data-src":a}),c[d].appendChild(f)}return this},run:function(a){a=a||{};var f={};A.vars.preempted=!0;var g=p(A.settings,a);f.renderer=g.renderer?g.renderer:A.setup.renderer,-1===A.setup.renderers.join(",").indexOf(f.renderer)&&(f.renderer=A.setup.supportsSVG?"svg":A.setup.supportsCanvas?"canvas":"html"),g.use_canvas?f.renderer="canvas":g.use_svg&&(f.renderer="svg");var h=t(g.images),i=t(g.bgnodes),j=t(g.stylenodes),k=t(g.objects);f.stylesheets=[],f.svgXMLStylesheet=!0,f.noFontFallback=g.noFontFallback?g.noFontFallback:!1;for(var m=0;m<j.length;m++){var n=j[m];if(n.attributes.rel&&n.attributes.href&&"stylesheet"==n.attributes.rel.value){var o=n.attributes.href.value,q=l("a");q.href=o;var r=q.protocol+"//"+q.host+q.pathname+q.search;f.stylesheets.push(r)}}for(m=0;m<i.length;m++){var s=b.getComputedStyle(i[m],null).getPropertyValue("background-image"),v=i[m].getAttribute("data-background-src"),w=null;w=null==v?s:v;var x=null,y="?"+g.domain+"/";if(0===w.indexOf(y))x=w.slice(1);else if(-1!=w.indexOf(y)){var z=w.substr(w.indexOf(y)).slice(1),B=z.match(/([^\"]*)"?\)/);null!=B&&(x=B[1])}if(null!=x){var C=d(x,g);C&&e("background",i[m],C,f)}}for(m=0;m<k.length;m++){var D=k[m],E={};try{E.data=D.getAttribute("data"),E.dataSrc=D.getAttribute("data-src")}catch(F){}var G=null!=E.data&&0===E.data.indexOf(g.domain),H=null!=E.dataSrc&&0===E.dataSrc.indexOf(g.domain);G?c(g,f,E.data,D):H&&c(g,f,E.dataSrc,D)}for(m=0;m<h.length;m++){var I=h[m],J={};try{J.src=I.getAttribute("src"),J.dataSrc=I.getAttribute("data-src"),J.rendered=I.getAttribute("data-holder-rendered")}catch(F){}var K=null!=J.src,L=null!=J.dataSrc&&0===J.dataSrc.indexOf(g.domain),M=null!=J.rendered&&"true"==J.rendered;K?0===J.src.indexOf(g.domain)?c(g,f,J.src,I):L&&(M?c(g,f,J.dataSrc,I):!function(a,b,d,e,f){u(a,function(a){a||c(b,d,e,f)})}(J.src,g,f,J.dataSrc,I)):L&&c(g,f,J.dataSrc,I)}return this},invisibleErrorFn:function(){return function(a){if(a.hasAttribute("data-holder-invisible"))throw"Holder: invisible placeholder"}}};z.add_theme=z.addTheme,z.add_image=z.addImage,z.invisible_error_fn=z.invisibleErrorFn;var A={settings:{domain:"holder.js",images:"img",objects:"object",bgnodes:"body .holderjs",stylenodes:"head link.holderjs",stylesheets:[],themes:{gray:{background:"#EEEEEE",foreground:"#AAAAAA"},social:{background:"#3a5a97",foreground:"#FFFFFF"},industrial:{background:"#434A52",foreground:"#C2F200"},sky:{background:"#0D8FDB",foreground:"#FFFFFF"},vine:{background:"#39DBAC",foreground:"#1E292C"},lava:{background:"#F8591A",foreground:"#1C2846"}}},defaults:{size:10,units:"pt",scale:1/16},flags:{dimensions:{regex:/^(\d+)x(\d+)$/,output:function(a){var b=this.regex.exec(a);return{width:+b[1],height:+b[2]}}},fluid:{regex:/^([0-9]+%?)x([0-9]+%?)$/,output:function(a){var b=this.regex.exec(a);return{width:b[1],height:b[2]}}},colors:{regex:/(?:#|\^)([0-9a-f]{3,})\:(?:#|\^)([0-9a-f]{3,})/i,output:function(a){var b=this.regex.exec(a);return{foreground:"#"+b[2],background:"#"+b[1]}}},text:{regex:/text\:(.*)/,output:function(a){return this.regex.exec(a)[1].replace("\\/","/")}},font:{regex:/font\:(.*)/,output:function(a){return this.regex.exec(a)[1]}},auto:{regex:/^auto$/},textmode:{regex:/textmode\:(.*)/,output:function(a){return this.regex.exec(a)[1]}},random:{regex:/^random$/}}},B=function(){var a=null,b=null,c=null;return function(d){var e=d.root;if(A.setup.supportsSVG){var f=!1,g=function(a){return y.createTextNode(a)};null==a&&(f=!0),a=n(a,e.properties.width,e.properties.height),f&&(b=l("text",x),c=g(null),m(b,{x:0}),b.appendChild(c),a.appendChild(b),y.body.appendChild(a),a.style.visibility="hidden",a.style.position="absolute",a.style.top="-100%",a.style.left="-100%");var h=e.children.holderTextGroup,i=h.properties;m(b,{y:i.font.size,style:q({"font-weight":i.font.weight,"font-size":i.font.size+i.font.units,"font-family":i.font.family,"dominant-baseline":"middle"})}),c.nodeValue=i.text;var j=b.getBBox(),k=Math.ceil(j.width/(e.properties.width*A.setup.lineWrapRatio)),o=i.text.split(" "),p=i.text.match(/\\n/g);k+=null==p?0:p.length,c.nodeValue=i.text.replace(/[ ]+/g,"");var r=b.getComputedTextLength(),s=j.width-r,t=Math.round(s/Math.max(1,o.length-1)),u=[];if(k>1){c.nodeValue="";for(var v=0;v<o.length;v++)if(0!==o[v].length){c.nodeValue=w(o[v]);var z=b.getBBox();u.push({text:o[v],width:z.width})}}return{spaceWidth:t,lineCount:k,boundingBox:j,words:u}}return!1}}(),C=function(){var a=l("canvas"),b=null;return function(c){null==b&&(b=a.getContext("2d"));var d=c.root;a.width=A.dpr(d.properties.width),a.height=A.dpr(d.properties.height),b.textBaseline="middle",b.fillStyle=d.children.holderBg.properties.fill,b.fillRect(0,0,A.dpr(d.children.holderBg.width),A.dpr(d.children.holderBg.height));var e=d.children.holderTextGroup;e.properties,b.font=e.properties.font.weight+" "+A.dpr(e.properties.font.size)+e.properties.font.units+" "+e.properties.font.family+", monospace",b.fillStyle=e.properties.fill;for(var f in e.children){var g=e.children[f];for(var h in g.children){var i=g.children[h],j=A.dpr(e.x+g.x+i.x),k=A.dpr(e.y+g.y+i.y+e.properties.leading/2);b.fillText(i.properties.text,j,k)}}return a.toDataURL("image/png")}}(),D=function(){if(b.XMLSerializer){var a=n(null,0,0),c=l("rect",x);return a.appendChild(c),function(b,d){var e=b.root;n(a,e.properties.width,e.properties.height);for(var f=a.querySelectorAll("g"),g=0;g<f.length;g++)f[g].parentNode.removeChild(f[g]);m(c,{width:e.children.holderBg.width,height:e.children.holderBg.height,fill:e.children.holderBg.properties.fill});var h=e.children.holderTextGroup,i=h.properties,j=l("g",x);a.appendChild(j);for(var k in h.children){var p=h.children[k];for(var r in p.children){var s=p.children[r],t=h.x+p.x+s.x,u=h.y+p.y+s.y+h.properties.leading/2,v=l("text",x),w=y.createTextNode(null);m(v,{x:t,y:u,style:q({fill:i.fill,"font-weight":i.font.weight,"font-family":i.font.family+", monospace","font-size":i.font.size+i.font.units,"dominant-baseline":"central"})}),w.nodeValue=s.properties.text,v.appendChild(w),j.appendChild(v)}}var z="data:image/svg+xml;base64,"+btoa(unescape(encodeURIComponent(o(a,d))));return z}}}(),E=function(a){function b(a,b){for(var c in b)a[c]=b[c];return a}var c=1,d=augment.defclass({constructor:function(a){c++,this.parent=null,this.children={},this.id=c,this.name="n"+c,null!=a&&(this.name=a),this.x=0,this.y=0,this.z=0,this.width=0,this.height=0},resize:function(a,b){null!=a&&(this.width=a),null!=b&&(this.height=b)},moveTo:function(a,b,c){this.x=null!=a?a:this.x,this.y=null!=b?b:this.y,this.z=null!=c?c:this.z},add:function(a){var b=a.name;if(null!=this.children[b])throw"SceneGraph: child with that name already exists: "+b;this.children[b]=a,a.parent=this}}),e=augment(d,function(b){this.constructor=function(){b.constructor.call(this,"root"),this.properties=a}}),f=augment(d,function(a){function c(c,d){if(a.constructor.call(this,c),this.properties={fill:"#000"},null!=d)b(this.properties,d);else if(null!=c&&"string"!=typeof c)throw"SceneGraph: invalid node name"}this.Group=augment.extend(this,{constructor:c,type:"group"}),this.Rect=augment.extend(this,{constructor:c,type:"rect"}),this.Text=augment.extend(this,{constructor:function(a){c.call(this),this.properties.text=a},type:"text"})}),g=new e;return this.Shape=f,this.root=g,this};for(var F in A.flags)A.flags.hasOwnProperty(F)&&(A.flags[F].match=function(a){return a.match(this.regex)});A.setup={renderer:"html",debounce:100,ratio:1,supportsCanvas:!1,supportsSVG:!1,lineWrapRatio:.9,renderers:["html","canvas","svg"]},A.dpr=function(a){return a*A.setup.ratio},A.vars={preempted:!1,resizableImages:[],debounceTimer:null,cache:{}},function(){var a=1,c=1,d=l("canvas"),e=null;d.getContext&&-1!=d.toDataURL("image/png").indexOf("data:image/png")&&(A.setup.renderer="canvas",e=d.getContext("2d"),A.setup.supportsCanvas=!0),A.setup.supportsCanvas&&(a=b.devicePixelRatio||1,c=e.webkitBackingStorePixelRatio||e.mozBackingStorePixelRatio||e.msBackingStorePixelRatio||e.oBackingStorePixelRatio||e.backingStorePixelRatio||1),A.setup.ratio=a/c,y.createElementNS&&y.createElementNS(x,"svg").createSVGRect&&(A.setup.renderer="svg",A.setup.supportsSVG=!0)}(),a(z,"Holder",b),b.onDomReady&&b.onDomReady(function(){A.vars.preempted||z.run(),b.addEventListener?(b.addEventListener("resize",s,!1),b.addEventListener("orientationchange",s,!1)):b.attachEvent("onresize",s),"object"==typeof b.Turbolinks&&b.document.addEventListener("page:change",function(){z.run()})})}(function(a,b,c){var d="function"==typeof define&&define.amd;d?define(a):c[b]=a},this),/*!
* ZeroClipboard
* The ZeroClipboard library provides an easy way to copy text to the clipboard using an invisible Adobe Flash movie and a JavaScript interface.
* Copyright (c) 2014 Jon Rohan, James M. Greene
* Licensed MIT
* http://zeroclipboard.org/
* v1.3.5
*/
    !function(a){"use strict";function b(a){return a.replace(/,/g,".").replace(/[^0-9\.]/g,"")}function c(a){return parseFloat(b(a))>=10}var d,e={bridge:null,version:"0.0.0",disabled:null,outdated:null,ready:null},f={},g=0,h={},i=0,j={},k=null,l=null,m=function(){var a,b,c,d,e="ZeroClipboard.swf";if(document.currentScript&&(d=document.currentScript.src));else{var f=document.getElementsByTagName("script");if("readyState"in f[0])for(a=f.length;a--&&("interactive"!==f[a].readyState||!(d=f[a].src)););else if("loading"===document.readyState)d=f[f.length-1].src;else{for(a=f.length;a--;){if(c=f[a].src,!c){b=null;break}if(c=c.split("#")[0].split("?")[0],c=c.slice(0,c.lastIndexOf("/")+1),null==b)b=c;else if(b!==c){b=null;break}}null!==b&&(d=b)}}return d&&(d=d.split("#")[0].split("?")[0],e=d.slice(0,d.lastIndexOf("/")+1)+e),e}(),n=function(){var a=/\-([a-z])/g,b=function(a,b){return b.toUpperCase()};return function(c){return c.replace(a,b)}}(),o=function(b,c){var d,e,f;return a.getComputedStyle?d=a.getComputedStyle(b,null).getPropertyValue(c):(e=n(c),d=b.currentStyle?b.currentStyle[e]:b.style[e]),"cursor"!==c||d&&"auto"!==d||(f=b.tagName.toLowerCase(),"a"!==f)?d:"pointer"},p=function(b){b||(b=a.event);var c;this!==a?c=this:b.target?c=b.target:b.srcElement&&(c=b.srcElement),K.activate(c)},q=function(a,b,c){a&&1===a.nodeType&&(a.addEventListener?a.addEventListener(b,c,!1):a.attachEvent&&a.attachEvent("on"+b,c))},r=function(a,b,c){a&&1===a.nodeType&&(a.removeEventListener?a.removeEventListener(b,c,!1):a.detachEvent&&a.detachEvent("on"+b,c))},s=function(a,b){if(!a||1!==a.nodeType)return a;if(a.classList)return a.classList.contains(b)||a.classList.add(b),a;if(b&&"string"==typeof b){var c=(b||"").split(/\s+/);if(1===a.nodeType)if(a.className){for(var d=" "+a.className+" ",e=a.className,f=0,g=c.length;g>f;f++)d.indexOf(" "+c[f]+" ")<0&&(e+=" "+c[f]);a.className=e.replace(/^\s+|\s+$/g,"")}else a.className=b}return a},t=function(a,b){if(!a||1!==a.nodeType)return a;if(a.classList)return a.classList.contains(b)&&a.classList.remove(b),a;if(b&&"string"==typeof b||void 0===b){var c=(b||"").split(/\s+/);if(1===a.nodeType&&a.className)if(b){for(var d=(" "+a.className+" ").replace(/[\n\t]/g," "),e=0,f=c.length;f>e;e++)d=d.replace(" "+c[e]+" "," ");a.className=d.replace(/^\s+|\s+$/g,"")}else a.className=""}return a},u=function(){var a,b,c,d=1;return"function"==typeof document.body.getBoundingClientRect&&(a=document.body.getBoundingClientRect(),b=a.right-a.left,c=document.body.offsetWidth,d=Math.round(b/c*100)/100),d},v=function(b,c){var d={left:0,top:0,width:0,height:0,zIndex:B(c)-1};if(b.getBoundingClientRect){var e,f,g,h=b.getBoundingClientRect();"pageXOffset"in a&&"pageYOffset"in a?(e=a.pageXOffset,f=a.pageYOffset):(g=u(),e=Math.round(document.documentElement.scrollLeft/g),f=Math.round(document.documentElement.scrollTop/g));var i=document.documentElement.clientLeft||0,j=document.documentElement.clientTop||0;d.left=h.left+e-i,d.top=h.top+f-j,d.width="width"in h?h.width:h.right-h.left,d.height="height"in h?h.height:h.bottom-h.top}return d},w=function(a,b){var c=null==b||b&&b.cacheBust===!0&&b.useNoCache===!0;return c?(-1===a.indexOf("?")?"?":"&")+"noCache="+(new Date).getTime():""},x=function(b){var c,d,e,f=[],g=[],h=[];if(b.trustedOrigins&&("string"==typeof b.trustedOrigins?g.push(b.trustedOrigins):"object"==typeof b.trustedOrigins&&"length"in b.trustedOrigins&&(g=g.concat(b.trustedOrigins))),b.trustedDomains&&("string"==typeof b.trustedDomains?g.push(b.trustedDomains):"object"==typeof b.trustedDomains&&"length"in b.trustedDomains&&(g=g.concat(b.trustedDomains))),g.length)for(c=0,d=g.length;d>c;c++)if(g.hasOwnProperty(c)&&g[c]&&"string"==typeof g[c]){if(e=E(g[c]),!e)continue;if("*"===e){h=[e];break}h.push.apply(h,[e,"//"+e,a.location.protocol+"//"+e])}return h.length&&f.push("trustedOrigins="+encodeURIComponent(h.join(","))),"string"==typeof b.jsModuleId&&b.jsModuleId&&f.push("jsModuleId="+encodeURIComponent(b.jsModuleId)),f.join("&")},y=function(a,b,c){if("function"==typeof b.indexOf)return b.indexOf(a,c);var d,e=b.length;for("undefined"==typeof c?c=0:0>c&&(c=e+c),d=c;e>d;d++)if(b.hasOwnProperty(d)&&b[d]===a)return d;return-1},z=function(a){if("string"==typeof a)throw new TypeError("ZeroClipboard doesn't accept query strings.");return a.length?a:[a]},A=function(b,c,d,e){e?a.setTimeout(function(){b.apply(c,d)},0):b.apply(c,d)},B=function(a){var b,c;return a&&("number"==typeof a&&a>0?b=a:"string"==typeof a&&(c=parseInt(a,10))&&!isNaN(c)&&c>0&&(b=c)),b||("number"==typeof N.zIndex&&N.zIndex>0?b=N.zIndex:"string"==typeof N.zIndex&&(c=parseInt(N.zIndex,10))&&!isNaN(c)&&c>0&&(b=c)),b||0},C=function(a,b){if(a&&b!==!1&&"undefined"!=typeof console&&console&&(console.warn||console.log)){var c="`"+a+"` is deprecated. See docs for more info:\n    https://github.com/zeroclipboard/zeroclipboard/blob/master/docs/instructions.md#deprecations";console.warn?console.warn(c):console.log(c)}},D=function(){var a,b,c,d,e,f,g=arguments[0]||{};for(a=1,b=arguments.length;b>a;a++)if(null!=(c=arguments[a]))for(d in c)if(c.hasOwnProperty(d)){if(e=g[d],f=c[d],g===f)continue;void 0!==f&&(g[d]=f)}return g},E=function(a){if(null==a||""===a)return null;if(a=a.replace(/^\s+|\s+$/g,""),""===a)return null;var b=a.indexOf("//");a=-1===b?a:a.slice(b+2);var c=a.indexOf("/");return a=-1===c?a:-1===b||0===c?null:a.slice(0,c),a&&".swf"===a.slice(-4).toLowerCase()?null:a||null},F=function(){var a=function(a,b){var c,d,e;if(null!=a&&"*"!==b[0]&&("string"==typeof a&&(a=[a]),"object"==typeof a&&"length"in a))for(c=0,d=a.length;d>c;c++)if(a.hasOwnProperty(c)&&(e=E(a[c]))){if("*"===e){b.length=0,b.push("*");break}-1===y(e,b)&&b.push(e)}},b={always:"always",samedomain:"sameDomain",never:"never"};return function(c,d){var e,f=d.allowScriptAccess;if("string"==typeof f&&(e=f.toLowerCase())&&/^always|samedomain|never$/.test(e))return b[e];var g=E(d.moviePath);null===g&&(g=c);var h=[];a(d.trustedOrigins,h),a(d.trustedDomains,h);var i=h.length;if(i>0){if(1===i&&"*"===h[0])return"always";if(-1!==y(c,h))return 1===i&&c===g?"sameDomain":"always"}return"never"}}(),G=function(a){if(null==a)return[];if(Object.keys)return Object.keys(a);var b=[];for(var c in a)a.hasOwnProperty(c)&&b.push(c);return b},H=function(a){if(a)for(var b in a)a.hasOwnProperty(b)&&delete a[b];return a},I=function(){try{return document.activeElement}catch(a){}return null},J=function(){var a=!1;if("boolean"==typeof e.disabled)a=e.disabled===!1;else{if("function"==typeof ActiveXObject)try{new ActiveXObject("ShockwaveFlash.ShockwaveFlash")&&(a=!0)}catch(b){}!a&&navigator.mimeTypes["application/x-shockwave-flash"]&&(a=!0)}return a},K=function(a,b){return this instanceof K?(this.id=""+g++,h[this.id]={instance:this,elements:[],handlers:{}},a&&this.clip(a),"undefined"!=typeof b&&(C("new ZeroClipboard(elements, options)",N.debug),K.config(b)),this.options=K.config(),"boolean"!=typeof e.disabled&&(e.disabled=!J()),void(e.disabled===!1&&e.outdated!==!0&&null===e.bridge&&(e.outdated=!1,e.ready=!1,O()))):new K(a,b)};K.prototype.setText=function(a){return a&&""!==a&&(f["text/plain"]=a,e.ready===!0&&e.bridge&&"function"==typeof e.bridge.setText?e.bridge.setText(a):e.ready=!1),this},K.prototype.setSize=function(a,b){return e.ready===!0&&e.bridge&&"function"==typeof e.bridge.setSize?e.bridge.setSize(a,b):e.ready=!1,this};var L=function(a){e.ready===!0&&e.bridge&&"function"==typeof e.bridge.setHandCursor?e.bridge.setHandCursor(a):e.ready=!1};K.prototype.destroy=function(){this.unclip(),this.off(),delete h[this.id]};var M=function(){var a,b,c,d=[],e=G(h);for(a=0,b=e.length;b>a;a++)c=h[e[a]].instance,c&&c instanceof K&&d.push(c);return d};K.version="1.3.5";var N={swfPath:m,trustedDomains:a.location.host?[a.location.host]:[],cacheBust:!0,forceHandCursor:!1,zIndex:999999999,debug:!0,title:null,autoActivate:!0};K.config=function(a){if("object"==typeof a&&null!==a&&D(N,a),"string"!=typeof a||!a){var b={};for(var c in N)N.hasOwnProperty(c)&&(b[c]="object"==typeof N[c]&&null!==N[c]?"length"in N[c]?N[c].slice(0):D({},N[c]):N[c]);return b}return N.hasOwnProperty(a)?N[a]:void 0},K.destroy=function(){K.deactivate();for(var a in h)if(h.hasOwnProperty(a)&&h[a]){var b=h[a].instance;b&&"function"==typeof b.destroy&&b.destroy()}var c=P(e.bridge);c&&c.parentNode&&(c.parentNode.removeChild(c),e.ready=null,e.bridge=null)},K.activate=function(a){d&&(t(d,N.hoverClass),t(d,N.activeClass)),d=a,s(a,N.hoverClass),Q();var b=N.title||a.getAttribute("title");if(b){var c=P(e.bridge);c&&c.setAttribute("title",b)}var f=N.forceHandCursor===!0||"pointer"===o(a,"cursor");L(f)},K.deactivate=function(){var a=P(e.bridge);a&&(a.style.left="0px",a.style.top="-9999px",a.removeAttribute("title")),d&&(t(d,N.hoverClass),t(d,N.activeClass),d=null)};var O=function(){var b,c,d=document.getElementById("global-zeroclipboard-html-bridge");if(!d){var f=K.config();f.jsModuleId="string"==typeof k&&k||"string"==typeof l&&l||null;var g=F(a.location.host,N),h=x(f),i=N.moviePath+w(N.moviePath,N),j='      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" id="global-zeroclipboard-flash-bridge" width="100%" height="100%">         <param name="movie" value="'+i+'"/>         <param name="allowScriptAccess" value="'+g+'"/>         <param name="scale" value="exactfit"/>         <param name="loop" value="false"/>         <param name="menu" value="false"/>         <param name="quality" value="best" />         <param name="bgcolor" value="#ffffff"/>         <param name="wmode" value="transparent"/>         <param name="flashvars" value="'+h+'"/>         <embed src="'+i+'"           loop="false" menu="false"           quality="best" bgcolor="#ffffff"           width="100%" height="100%"           name="global-zeroclipboard-flash-bridge"           allowScriptAccess="'+g+'"           allowFullScreen="false"           type="application/x-shockwave-flash"           wmode="transparent"           pluginspage="http://www.macromedia.com/go/getflashplayer"           flashvars="'+h+'"           scale="exactfit">         </embed>       </object>';d=document.createElement("div"),d.id="global-zeroclipboard-html-bridge",d.setAttribute("class","global-zeroclipboard-container"),d.style.position="absolute",d.style.left="0px",d.style.top="-9999px",d.style.width="15px",d.style.height="15px",d.style.zIndex=""+B(N.zIndex),document.body.appendChild(d),d.innerHTML=j}b=document["global-zeroclipboard-flash-bridge"],b&&(c=b.length)&&(b=b[c-1]),e.bridge=b||d.children[0].lastElementChild},P=function(a){for(var b=/^OBJECT|EMBED$/,c=a&&a.parentNode;c&&b.test(c.nodeName)&&c.parentNode;)c=c.parentNode;return c||null},Q=function(){if(d){var a=v(d,N.zIndex),b=P(e.bridge);b&&(b.style.top=a.top+"px",b.style.left=a.left+"px",b.style.width=a.width+"px",b.style.height=a.height+"px",b.style.zIndex=a.zIndex+1),e.ready===!0&&e.bridge&&"function"==typeof e.bridge.setSize?e.bridge.setSize(a.width,a.height):e.ready=!1}return this};K.prototype.on=function(a,b){var c,d,f,g={},i=h[this.id]&&h[this.id].handlers;if("string"==typeof a&&a)f=a.toLowerCase().split(/\s+/);else if("object"==typeof a&&a&&"undefined"==typeof b)for(c in a)a.hasOwnProperty(c)&&"string"==typeof c&&c&&"function"==typeof a[c]&&this.on(c,a[c]);if(f&&f.length){for(c=0,d=f.length;d>c;c++)a=f[c].replace(/^on/,""),g[a]=!0,i[a]||(i[a]=[]),i[a].push(b);g.noflash&&e.disabled&&T.call(this,"noflash",{}),g.wrongflash&&e.outdated&&T.call(this,"wrongflash",{flashVersion:e.version}),g.load&&e.ready&&T.call(this,"load",{flashVersion:e.version})}return this},K.prototype.off=function(a,b){var c,d,e,f,g,i=h[this.id]&&h[this.id].handlers;if(0===arguments.length)f=G(i);else if("string"==typeof a&&a)f=a.split(/\s+/);else if("object"==typeof a&&a&&"undefined"==typeof b)for(c in a)a.hasOwnProperty(c)&&"string"==typeof c&&c&&"function"==typeof a[c]&&this.off(c,a[c]);if(f&&f.length)for(c=0,d=f.length;d>c;c++)if(a=f[c].toLowerCase().replace(/^on/,""),g=i[a],g&&g.length)if(b)for(e=y(b,g);-1!==e;)g.splice(e,1),e=y(b,g,e);else i[a].length=0;return this},K.prototype.handlers=function(a){var b,c=null,d=h[this.id]&&h[this.id].handlers;if(d){if("string"==typeof a&&a)return d[a]?d[a].slice(0):null;c={};for(b in d)d.hasOwnProperty(b)&&d[b]&&(c[b]=d[b].slice(0))}return c};var R=function(b,c,d,e){var f=h[this.id]&&h[this.id].handlers[b];if(f&&f.length){var g,i,j,k=c||this;for(g=0,i=f.length;i>g;g++)j=f[g],c=k,"string"==typeof j&&"function"==typeof a[j]&&(j=a[j]),"object"==typeof j&&j&&"function"==typeof j.handleEvent&&(c=j,j=j.handleEvent),"function"==typeof j&&A(j,c,d,e)}return this};K.prototype.clip=function(a){a=z(a);for(var b=0;b<a.length;b++)if(a.hasOwnProperty(b)&&a[b]&&1===a[b].nodeType){a[b].zcClippingId?-1===y(this.id,j[a[b].zcClippingId])&&j[a[b].zcClippingId].push(this.id):(a[b].zcClippingId="zcClippingId_"+i++,j[a[b].zcClippingId]=[this.id],N.autoActivate===!0&&q(a[b],"mouseover",p));var c=h[this.id].elements;-1===y(a[b],c)&&c.push(a[b])}return this},K.prototype.unclip=function(a){var b=h[this.id];if(b){var c,d=b.elements;a="undefined"==typeof a?d.slice(0):z(a);for(var e=a.length;e--;)if(a.hasOwnProperty(e)&&a[e]&&1===a[e].nodeType){for(c=0;-1!==(c=y(a[e],d,c));)d.splice(c,1);var f=j[a[e].zcClippingId];if(f){for(c=0;-1!==(c=y(this.id,f,c));)f.splice(c,1);0===f.length&&(N.autoActivate===!0&&r(a[e],"mouseover",p),delete a[e].zcClippingId)}}}return this},K.prototype.elements=function(){var a=h[this.id];return a&&a.elements?a.elements.slice(0):[]};var S=function(a){var b,c,d,e,f,g=[];if(a&&1===a.nodeType&&(b=a.zcClippingId)&&j.hasOwnProperty(b)&&(c=j[b],c&&c.length))for(d=0,e=c.length;e>d;d++)f=h[c[d]].instance,f&&f instanceof K&&g.push(f);return g};N.hoverClass="zeroclipboard-is-hover",N.activeClass="zeroclipboard-is-active",N.trustedOrigins=null,N.allowScriptAccess=null,N.useNoCache=!0,N.moviePath="ZeroClipboard.swf",K.detectFlashSupport=function(){return C("ZeroClipboard.detectFlashSupport",N.debug),J()},K.dispatch=function(a,b){if("string"==typeof a&&a){var c=a.toLowerCase().replace(/^on/,"");if(c)for(var e=d&&N.autoActivate===!0?S(d):M(),f=0,g=e.length;g>f;f++)T.call(e[f],c,b)}},K.prototype.setHandCursor=function(a){return C("ZeroClipboard.prototype.setHandCursor",N.debug),a="boolean"==typeof a?a:!!a,L(a),N.forceHandCursor=a,this},K.prototype.reposition=function(){return C("ZeroClipboard.prototype.reposition",N.debug),Q()},K.prototype.receiveEvent=function(a,b){if(C("ZeroClipboard.prototype.receiveEvent",N.debug),"string"==typeof a&&a){var c=a.toLowerCase().replace(/^on/,"");c&&T.call(this,c,b)}},K.prototype.setCurrent=function(a){return C("ZeroClipboard.prototype.setCurrent",N.debug),K.activate(a),this},K.prototype.resetBridge=function(){return C("ZeroClipboard.prototype.resetBridge",N.debug),K.deactivate(),this},K.prototype.setTitle=function(a){if(C("ZeroClipboard.prototype.setTitle",N.debug),a=a||N.title||d&&d.getAttribute("title")){var b=P(e.bridge);b&&b.setAttribute("title",a)}return this},K.setDefaults=function(a){C("ZeroClipboard.setDefaults",N.debug),K.config(a)},K.prototype.addEventListener=function(a,b){return C("ZeroClipboard.prototype.addEventListener",N.debug),this.on(a,b)},K.prototype.removeEventListener=function(a,b){return C("ZeroClipboard.prototype.removeEventListener",N.debug),this.off(a,b)},K.prototype.ready=function(){return C("ZeroClipboard.prototype.ready",N.debug),e.ready===!0};var T=function(a,g){a=a.toLowerCase().replace(/^on/,"");var h=g&&g.flashVersion&&b(g.flashVersion)||null,i=d,j=!0;switch(a){case"load":if(h){if(!c(h))return void T.call(this,"onWrongFlash",{flashVersion:h});e.outdated=!1,e.ready=!0,e.version=h}break;case"wrongflash":h&&!c(h)&&(e.outdated=!0,e.ready=!1,e.version=h);break;case"mouseover":s(i,N.hoverClass);break;case"mouseout":N.autoActivate===!0&&K.deactivate();break;case"mousedown":s(i,N.activeClass);break;case"mouseup":t(i,N.activeClass);break;case"datarequested":if(i){var k=i.getAttribute("data-clipboard-target"),l=k?document.getElementById(k):null;if(l){var m=l.value||l.textContent||l.innerText;m&&this.setText(m)}else{var n=i.getAttribute("data-clipboard-text");n&&this.setText(n)}}j=!1;break;case"complete":H(f),i&&i!==I()&&i.focus&&i.focus()}var o=i,p=[this,g];return R.call(this,a,o,p,j)};"function"==typeof define&&define.amd?define(["require","exports","module"],function(a,b,c){return k=c&&c.id||null,K}):"object"==typeof module&&module&&"object"==typeof module.exports&&module.exports&&"function"==typeof a.require?(l=module.id||null,module.exports=K):a.ZeroClipboard=K}(function(){return this}()),/*!
 * JavaScript for Bootstrap's docs (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under the Creative Commons Attribution 3.0 Unported License. For
 * details, see http://creativecommons.org/licenses/by/3.0/.
 */
    !function(a){"use strict";a(function(){var b=a(window),c=a(document.body);c.scrollspy({target:".bs-docs-sidebar"}),b.on("load",function(){c.scrollspy("refresh")}),a(".bs-docs-container [href=#]").click(function(a){a.preventDefault()}),setTimeout(function(){var b=a(".bs-docs-sidebar");b.affix({offset:{top:function(){var c=b.offset().top,d=parseInt(b.children(0).css("margin-top"),10),e=a(".bs-docs-nav").height();return this.top=c-e-d},bottom:function(){return this.bottom=a(".bs-docs-footer").outerHeight(!0)}}})},100),setTimeout(function(){a(".bs-top").affix()},100),function(){var b=a("#bs-theme-stylesheet"),c=a(".bs-docs-theme-toggle"),d=function(){b.attr("href",b.attr("data-href")),c.text("Disable theme preview"),localStorage.setItem("previewTheme",!0)};localStorage.getItem("previewTheme")&&d(),c.click(function(){var a=b.attr("href");a&&0!==a.indexOf("data")?(b.attr("href",""),c.text("Preview theme"),localStorage.removeItem("previewTheme")):d()})}(),a(".tooltip-demo").tooltip({selector:'[data-toggle="tooltip"]',container:"body"}),a(".popover-demo").popover({selector:'[data-toggle="popover"]',container:"body"}),a(".tooltip-test").tooltip(),a(".popover-test").popover(),a(".bs-docs-popover").popover(),a("#loading-example-btn").on("click",function(){var b=a(this);b.button("loading"),setTimeout(function(){b.button("reset")},3e3)}),a("#exampleModal").on("show.bs.modal",function(b){var c=a(b.relatedTarget),d=c.data("whatever"),e=a(this);e.find(".modal-title").text("New message to "+d),e.find(".modal-body input").val(d)}),a(".bs-docs-activate-animated-progressbar").on("click",function(){a(this).siblings(".progress").find(".progress-bar-striped").toggleClass("active")}),ZeroClipboard.config({moviePath:"/assets/flash/ZeroClipboard.swf",hoverClass:"btn-clipboard-hover"}),a(".highlight").each(function(){var b='<div class="zero-clipboard"><span class="btn-clipboard">Copy</span></div>';a(this).before(b)});var d=new ZeroClipboard(a(".btn-clipboard")),e=a("#global-zeroclipboard-html-bridge");d.on("load",function(){e.data("placement","top").attr("title","Copy to clipboard").tooltip()}),d.on("dataRequested",function(b){var c=a(this).parent().nextAll(".highlight").first();b.setText(c.text())}),d.on("complete",function(){e.attr("title","Copied!").tooltip("fixTitle").tooltip("show").attr("title","Copy to clipboard").tooltip("fixTitle")}),d.on("noflash wrongflash",function(){e.attr("title","Flash required").tooltip("fixTitle").tooltip("show")})})}(jQuery);


/*!
* IE10 viewport hack for Surface/desktop Windows 8 bug
* Copyright 2014 Twitter, Inc.
* Licensed under the Creative Commons Attribution 3.0 Unported License. For
* details, see http://creativecommons.org/licenses/by/3.0/.
*/

// See the Getting Started docs for more information:
// http://getbootstrap.com/getting-started/#support-ie10-width

(function () {
    'use strict';
    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style')
        msViewportStyle.appendChild(
            document.createTextNode(
                '@-ms-viewport{width:auto!important}'
            )
        )
        document.querySelector('head').appendChild(msViewportStyle)
    }
})();