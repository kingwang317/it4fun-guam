﻿/**
 * VERSION: 11.0996
 * DATE: 7/1/2009
 * AS3 (AS2 version is also available)
 * UPDATES & DOCUMENTATION AT: http://www.TweenLite.com
 **/
package gs {
	import flash.display.*;
	import flash.events.*;
	import flash.utils.*;
	
	import gs.core.tween.*;
	import gs.plugins.*;
/**
 * 	TweenLite is an extremely FAST, lightweight, and flexible tweening engine that serves as the core of 
 * 	the GreenSock Tweening Platform. There are plenty of other tweening engines out there to choose from,
 * 	so here's why you might want to consider TweenLite:
 * 	<ul>
 * 		<li><b> SPEED </b>- I'm not aware of any popular tweening engine with a similar feature set that's as fast
 * 		  	 as TweenLite. See some speed comparisons yourself at 
 * 			 <a href="http://blog.greensock.com/tweening-speed-test/">http://blog.greensock.com/tweening-speed-test/</a>
 * 		  
 * 		<li><b> Feature set </b>- In addition to tweening ANY numeric property of ANY object, TweenLite can tween filters, 
 * 		  	 hex colors, volume, tint, and frames, and even do bezier tweening, plus LOTS more. TweenMax extends 
 * 		  	 TweenLite and adds even more capabilities like pause/resume, rounding, event listeners, and more. 
 * 		  	 Overwrite management is an important consideration for a tweening engine as well which is another 
 * 		  	 area where the GreenSock tweening platform shines. You have options for AUTO overwriting or you can
 * 		  	 manually define how each tween will handle overlapping tweens of the same object.
 * 		  
 * 		<li><b> Expandability </b>- With its new plugin architecture, you can activate as many (or as few) features as your 
 * 		  	 project requires. Or write your own plugin if you need a feature that's unavailable. Minimize bloat, and
 * 		  	 maximize performance.
 * 		  
 * 		<li><b> Management features </b>- TimelineLite and TimelineMax make it surprisingly simple to create complex sequences 
 * 		  	 and groups of TweenLite/Max tweens that you can play(), stop(), restart(), or reverse(). You can even tween 
 * 		  	 a timeline's progress or time property to fastforward or rewind the entire timeline. Add labels, gotoAndPlay(),
 * 		  	 change the timeline's timeScale, nest timelines within timelines, and lots more.
 * 		  
 * 		<li><b> Ease of use </b>- Designers and Developers alike rave about how intuitive the GreenSock tweening platform is.
 * 		
 * 		<li><b> Updates </b>- Frequent updates and feature additions make the GreenSock tweening platform reliable and robust.
 * 		
 * 		<li><b> AS2 and AS3 </b>- Most other engines are only developed for AS2 or AS3 but not both.
 * 	</ul>
 * 
 * <hr>	
 * <b>SPECIAL PROPERTIES (no plugins required):</b>
 * <br /><br />
 * 
 * Any of the following special properties can optionally be passed in through the $vars object (the third parameter):
 * 
 * <ul>
 * 	<li><b> delay : Number</b>			Amount of delay before the tween should begin (in seconds).
 * 	
 * 	<li><b> useFrames : Boolean</b>		If useFrames is set to true, the tweens's timing mode will be based on frames. 
 * 										Otherwise, it will be based on seconds/time. NOTE: a tween's timing mode is 
 * 										always determined by its parent timeline. 
 * 	
 * 	<li><b> ease : Function</b>			Use any standard easing equation to control the rate of change. For example, 
 * 										gs.easing.Elastic.easeOut. The Default is Regular.easeOut.
 * 	
 * 	<li><b> easeParams : Array</b>		An Array of extra parameters to feed the easing equation. This can be useful when 
 * 										using an ease like Elastic and want to control extra parameters like the amplitude 
 * 										and period.	Most easing equations, however, don't require extra parameters so you 
 * 										won't need to pass in any easeParams.
 * 	
 * 	<li><b> onStart : Function</b>		A function that should be called when the tween begins.
 * 	
 * 	<li><b> onStartParams : Array</b>	An Array of parameters to pass the onStart function.
 * 	
 * 	<li><b> onUpdate : Function</b>		A function that should be called every time the tween's time/position is updated 
 * 										(on every frame while the timeline is active)
 * 	
 * 	<li><b> onUpdateParams : Array</b>	An Array of parameters to pass the onUpdate function
 * 	
 * 	<li><b> onComplete : Function</b>	A function that should be called when the tween has finished 
 * 	
 * 	<li><b> onCompleteParams : Array</b> An Array of parameters to pass the onComplete function
 * 	
 * 	<li><b> immediateRender : Boolean</b> Normally when you create a tween, it begins rendering on the very next frame (when 
 * 											the Flash Player dispatches an ENTER_FRAME event) unless you specify a "delay". This 
 * 											allows you to insert tweens into timelines and perform other actions that may affect 
 * 											its timing. However, if you prefer to force the tween to render immediately when it is 
 * 											created, set immediateRender to true. Or to prevent a tween with a duration of zero from
 * 											rendering immediately, set immediateRender to false.
 * 	
 * 	<li><b> overwrite : int</b>			Controls how other tweens of the same object are handled when this tween is created. Here are the options:
 * 										<ul>
 * 			  							<li><b> 0 (NONE):</b> No tweens are overwritten. This is the fastest mode, but you need to be careful not to create any 
 * 			  										tweens with overlapping properties, otherwise they'll conflict with each other. 
 * 											
 * 										<li><b> 1 (ALL):</b> (this is the default unless OverwriteManager.init() has been called) All tweens of the same object 
 * 												   are completely overwritten immediately when the tween is created. <br /><code>
 * 												   		TweenLite.to(mc, 1, {x:100, y:200});<br />
 * 														TweenLite.to(mc, 1, {x:300, delay:2, overwrite:1}); //immediately overwrites the previous tween</code>
 * 												
 * 										<li><b> 2 (AUTO):</b> (used by default if OverwriteManager.init() has been called) Searches for and overwrites only 
 * 													individual overlapping properties in tweens that are active when the tween begins. <br /><code>
 * 														TweenLite.to(mc, 1, {x:100, y:200});<br />
 * 														TweenLite.to(mc, 1, {x:300, overwrite:2}); //only overwrites the "x" property in the previous tween</code>
 * 												
 * 										<li><b> 3 (CONCURRENT):</b> Overwrites all tweens of the same object that are active when the tween begins.<br /><code>
 * 														  TweenLite.to(mc, 1, {x:100, y:200});<br />
 * 														  TweenLite.to(mc, 1, {x:300, delay:2, overwrite:3}); //does NOT overwrite the previous tween because the first tween will have finished by the time this one begins.</code>
 * 										</ul>
 * 	</ul>		
 * 
 * <b>PLUGINS:</b><br /><br />
 * 
 * 	There are many plugins that add capabilities through other special properties. Some examples are "tint", 
 * 	"volume", "frame", "frameLabel", "bezier", "blurFilter", "colorMatrixFilter", "hexColors", and many more.
 * 	Adding the capabilities is as simple as activating the plugin with a single line of code, like 
 * 	TweenPlugin.activate([TintPlugin]); Get information about all the plugins at 
 *  <a href="http://www.TweenLite.com">http://www.TweenLite.com</a><br /><br />
 * 
 * <b>EXAMPLES:</b> <br /><br />
 * 
 * 	Tween the the MovieClip "mc" to an alpha value of 0.5 (50% transparent) and an x-coordinate of 120 
 * 	over the course of 1.5 seconds like so:<br /><br />
 * 	
 * <code>
 * 		import gs.TweenLite;<br /><br />
 * 		TweenLite.to(mc, 1.5, {alpha:0.5, x:120});
 * 	</code><br /><br />
 *  
 * 	To tween the "mc" MovieClip's alpha property to 0.5, its x property to 120 using the "Back.easeOut" easing 
 *  function, delay starting the whole tween by 2 seconds, and then call a function named "onFinishTween" when it 
 *  has completed (it will have a duration of 5 seconds) and pass a few parameters to that function (a value of 
 *  5 and a reference to the mc), you'd do so like:<br /><br />
 * 		
 * 	<code>
 * 		import gs.TweenLite;<br />
 * 		import gs.easing.Back;<br /><br />
 * 		TweenLite.to(mc, 5, {alpha:0.5, x:120, ease:Back.easeOut, delay:2, onComplete:onFinishTween, onCompleteParams:[5, mc]});<br />
 * 		function onFinishTween(param1:Number, param2:MovieClip):void {<br />
 * 			trace("The tween has finished! param1 = " + param1 + ", and param2 = " + param2);<br />
 * 		}
 * 	</code><br /><br />
 *  
 * 	If you have a MovieClip on the stage that is already in it's end position and you just want to animate it into 
 * 	place over 5 seconds (drop it into place by changing its y property to 100 pixels higher on the screen and 
 * 	dropping it from there), you could:<br /><br />
 * 	
 *  <code>
 * 		import gs.TweenLite;<br />
 * 		import gs.easing.Elastic;<br /><br />
 * 		TweenLite.from(mc, 5, {y:"-100", ease:Elastic.easeOut});		
 *  </code><br /><br />
 * 
 * <b>NOTES:</b><br /><br />
 * <ul>
 * 	<li> The base TweenLite class adds about 3.9kb to your Flash file, but if you activate the plugins
 * 	  that were activated by default in versions prior to 11 (tint, removeTint, frame, endArray, visible, and autoAlpha), 
 * 	  it totals about 6k.
 * 	  
 * 	<li> Passing values as Strings will make the tween relative to the current value. For example, if you do
 * 	  <code>TweenLite.to(mc, 2, {x:"-20"});</code> it'll move the mc.x to the left 20 pixels which is the same as doing
 * 	  <code>TweenLite.to(mc, 2, {x:mc.x - 20});</code> You could also cast it like: <code>TweenLite.to(mc, 2, {x:String(myVariable)});</code>
 * 	  
 * 	<li> You can change the <code>TweenLite.defaultEase</code> function if you prefer something other than <code>Regular.easeOut</code>.
 * 	
 * 	<li> Kill all tweens for a particular object anytime with the <code>TweenLite.killTweensOf(mc); </code>
 * 	  function. If you want to have the tweens forced to completion, pass true as the second parameter, 
 * 	  like <code>TweenLite.killTweensOf(mc, true);</code>
 * 	  
 * 	<li> You can kill all delayedCalls to a particular function using <code>TweenLite.killDelayedCallsTo(myFunction);</code>
 * 	  This can be helpful if you want to preempt a call.
 * 	  
 * 	<li> Use the <code>TweenLite.from()</code> method to animate things into place. For example, if you have things set up on 
 * 	  the stage in the spot where they should end up, and you just want to animate them into place, you can 
 * 	  pass in the beginning x and/or y and/or alpha (or whatever properties you want).
 * 	  
 * 	<li> If you find this class useful, please consider joining Club GreenSock which not only contributes
 * 	  to ongoing development, but also gets you bonus classes (and other benefits) that are ONLY available 
 * 	  to members. Learn more at <a href="http://blog.greensock.com/club/">http://blog.greensock.com/club/</a>
 * </ul>
 * 
 * <b>Copyright 2009, GreenSock. All rights reserved.</b> This work is subject to the terms in <a href="http://www.greensock.com/terms_of_use.html">http://www.greensock.com/terms_of_use.html</a> or for corporate Club GreenSock members, the software agreement that was issued with the corporate membership.
 * 
 * @author Jack Doyle, jack@greensock.com
 */	 
	public class TweenLite extends Tweenable {
		
		/**
		 * @private
		 * Initializes the class, activates default plugins, and starts the root timelines. This should only 
		 * be called internally. It is technically public only so that other classes in the GreenSock Tweening 
		 * Platform can access it, but again, please avoid calling this method directly.
		 */
		public static function initClass():void {
			
			
			//ACTIVATE PLUGINS HERE...
			/*
			TweenPlugin.activate([
							
				AutoAlphaPlugin,			//tweens alpha and then toggles "visible" to false if/when alpha is zero
				EndArrayPlugin,				//tweens numbers in an Array
				FramePlugin,				//tweens MovieClip frames
				RemoveTintPlugin,			//allows you to remove a tint
				TintPlugin,					//tweens tints
				VisiblePlugin,				//tweens a target's "visible" property
				VolumePlugin,				//tweens the volume of a MovieClip or SoundChannel or anything with a "soundTransform" property
				
				BevelFilterPlugin,			//tweens BevelFilters
				BezierPlugin,				//enables bezier tweening
				BezierThroughPlugin,		//enables bezierThrough tweening
				BlurFilterPlugin,			//tweens BlurFilters
				ColorMatrixFilterPlugin,	//tweens ColorMatrixFilters (including hue, saturation, colorize, contrast, brightness, and threshold)
				DropShadowFilterPlugin,		//tweens DropShadowFilters
				GlowFilterPlugin,			//tweens GlowFilters
				HexColorsPlugin,			//tweens hex colors
				ShortRotationPlugin,		//tweens rotation values in the shortest direction
				
				ColorTransformPlugin,		//tweens advanced color properties like exposure, brightness, tintAmount, redOffset, redMultiplier, etc.
				FrameLabelPlugin,			//tweens a MovieClip to particular label
				QuaternionsPlugin,			//tweens 3D Quaternions
				ScalePlugin,				//Tweens both the _xscale and _yscale properties
				ScrollRectPlugin,			//tweens the scrollRect property of a DisplayObject
				SetSizePlugin,				//tweens the width/height of components via setSize()
				SetActualSizePlugin			//tweens the width/height of components via setActualSize()
				TransformMatrixPlugin,		//Tweens the transform.matrix property of any DisplayObject
					
				//DynamicPropsPlugin,			//tweens to dynamic end values. You associate the property with a particular function that returns the target end value **Club GreenSock membership benefit**
				//MotionBlurPlugin,			//applies a directional blur to a DisplayObject based on the velocity and angle of movement. **Club GreenSock membership benefit**
				//TransformAroundCenterPlugin,//tweens the scale and/or rotation of DisplayObjects using the DisplayObject's center as the registration point **Club GreenSock membership benefit**
				//TransformAroundPointPlugin,	//tweens the scale and/or rotation of DisplayObjects around a particular point (like a custom registration point) **Club GreenSock membership benefit**
				
				
			{}]);
			*/
			
			rootFrame = 0;
			rootTimeline = new SimpleTimeline(null);
			rootFramesTimeline = new SimpleTimeline(null);
			rootTimeline.startTime = getTimer() * 0.001;
			rootFramesTimeline.startTime = rootFrame;
			rootTimeline.autoRemoveChildren = true;
			rootFramesTimeline.autoRemoveChildren = true;
			_shape.addEventListener(Event.ENTER_FRAME, updateAll, false, 0, true);
			if (overwriteManager == null) {
				overwriteManager = {mode:1, enabled:false};
			}
		}
		
		/** @private **/
		public static const version:Number = 11.0996;
		/** @private When plugins are activated, the class is added (named based on the special property) to this object so that we can quickly look it up in the initTweenVals() method.**/
		public static var plugins:Object = {}; 
		/** @private For notifying plugins of significant events like when the tween finishes initializing, when it is disabled/enabled, and when it completes (some plugins need to take actions when those events occur) **/
		public static var onPluginEvent:Function;
		/** @private **/
		public static var killDelayedCallsTo:Function = TweenLite.killTweensOf;
		/** Provides an easy way to change the default easing equation.**/
		public static var defaultEase:Function = TweenLite.easeOut; 
		/** @private Makes it possible to integrate OverwriteManager for adding various overwriting capabilities. **/
		public static var overwriteManager:Object; 
		/** @private Gets updated on every frame. This syncs all the tweens and prevents drifting of the startTime that happens under heavy loads with most other engines.**/
		public static var rootFrame:Number; 
		/** @private All tweens get associated with a timeline. The rootTimeline is the default for all time-based tweens.**/
		public static var rootTimeline:SimpleTimeline; 
		/** @private All tweens get associated with a timeline. The rootFramesTimeline is the default for all frames-based tweens.**/
		public static var rootFramesTimeline:SimpleTimeline;
		/** @private Holds references to all our tween instances organized by target for quick lookups (for overwriting).**/
		public static var masterList:Dictionary = new Dictionary(false); 
		/** @private Drives all our ENTER_FRAME events.**/
		private static var _shape:Shape = new Shape(); 
		/** @private Lookup for all of the reserved "special property" keywords.**/
		protected static var _reservedProps:Object = {ease:1, delay:1, overwrite:1, onComplete:1, onCompleteParams:1, useFrames:1, runBackwards:1, startAt:1, onUpdate:1, onUpdateParams:1, roundProps:1, onStart:1, onStartParams:1, onReverseComplete:1, onReverseCompleteParams:1, onRepeat:1, onRepeatParams:1, proxiedEase:1, easeParams:1, yoyo:1, onCompleteListener:1, onUpdateListener:1, onStartListener:1, orientToBezier:1, timeScale:1, immediateRender:1, repeat:1, repeatDelay:1, timeline:1, data:1, paused:1};
		
		
		/** Target object whose properties this tween affects. This can be ANY object, not just a DisplayObject. **/
		public var target:Object; 
		/** Easing method to use which determines how the values animate over time. Examples are Elastic.easeOut and Strong.easeIn. Many are found in the fl.motion.easing package or gs.easing. **/
		public var ease:Function;
		/** @private Lookup object for PropTween objects. For example, if this tween is handling the "x" and "y" properties of the target, the propTweenLookup object will have an "x" and "y" property, each pointing to the associated PropTween object. This can be very helpful for speeding up overwriting. This is a public variable, but should almost never be used directly. **/
		public var propTweenLookup:Object; 
		
		/** @private All the PropTween instances are stored in a linked list for speed. Traverse them using nextNode and prevNode. **/
		protected var _firstPropTween:PropTween; 
		/** @private When other tweens overwrite properties in this tween, the properties get added to this object. Remember, sometimes properties are overwritten BEFORE the tween inits, like when two tweens start at the same time, the later one overwrites the previous one. **/
		protected var _overwrittenProps:Object; 
		/** @private If this tween has any TweenPlugins, we set this to true - it helps speed things up in onComplete **/
		protected var _hasPlugins:Boolean; 
		/** @private If this tween has any TweenPlugins that need to be notified of a change in the "enabled" status, this will be true. (speeds things up in the enabled setter) **/
		protected var _notifyPluginsOfEnabled:Boolean;
		
		
		/**
		 * Constructor
		 *  
		 * @param $target Target object whose properties this tween affects. This can be ANY object, not just a DisplayObject. 
		 * @param $duration Duration in seconds (or in frames if the tween's timing mode is frames-based)
		 * @param $vars An object containing the end values of the properties you're tweening. For example, to tween to x=100, y=100, you could pass {x:100, y:100}. It can also contain special properties like "onComplete", "ease", "delay", etc.
		 */
		public function TweenLite($target:Object, $duration:Number, $vars:Object) {
			super($duration, $vars);
			this.ease = (typeof(this.vars.ease) != "function") ? defaultEase : this.vars.ease;
			this.target = $target;
			if (this.vars.easeParams != null) {
				this.vars.proxiedEase = this.ease;
				this.ease = easeProxy;
			}
			propTweenLookup = {};
			
			//handle overwriting (if necessary) and add the tween to the Dictionary for future
			if (!($target in masterList)) {
				masterList[$target] = [this];
			} else { 
				var mode:int = ($vars.overwrite == undefined || (!overwriteManager.enabled && $vars.overwrite > 1)) ? overwriteManager.mode : int($vars.overwrite);
				if (mode == 1) { //overwrite all other existing tweens of the same object (ALL mode)
					var siblings:Array = masterList[$target], sibling:TweenLite;
					for each (sibling in siblings) {
						if (!sibling.gc) {
							sibling.setEnabled(false, false);
						}
					}
					masterList[$target] = [this];
				} else {
					masterList[$target].push(this);
				}
			}
			
			if (this.active || this.vars.immediateRender) {
				renderTime(0, false, true);
			}
		}
		
		/**
		 * @private
		 * Initializes the property tweens, determining their start values and amount of change. 
		 * Also triggers overwriting if necessary and sets the _hasUpdate variable.
		 */
		protected function init():void {
			var p:String, i:int, plugin:*, prioritize:Boolean, enumerables:Object = (this.vars.isTV == true) ? this.vars.exposedVars : this.vars; //for TweenLiteVars and TweenMaxVars (we need an object with enumerable properties);
			propTweenLookup = {};
			if (enumerables.timeScale != undefined && this.target is Tweenable) { //in case we're tweening the timeScale of another tween or timeline.
				_firstPropTween = insertPropTween(this.target, "timeScale", this.target.timeScale, enumerables.timeScale, "timeScale", false, _firstPropTween); 
			}
			for (p in enumerables) {
				if (p in _reservedProps) { 
					//ignore
				} else if (p in plugins) {
					plugin = new plugins[p]();
					if (plugin.onInitTween(this.target, enumerables[p], this) == false) { //if the plugin init fails, do a regular tween
						_firstPropTween = insertPropTween(this.target, p, this.target[p], enumerables[p], p, false, _firstPropTween); 
					} else {
						_firstPropTween = insertPropTween(plugin, "changeFactor", 0, 1, (plugin.overwriteProps.length == 1) ? plugin.overwriteProps[0] : "_MULTIPLE_", true, _firstPropTween); 
						_hasPlugins = true;
						if (plugin.priority != 0) {
							_firstPropTween.priority = plugin.priority;
							prioritize = true;
						}
						if (plugin.onDisable != null || plugin.onEnable != null) {
							_notifyPluginsOfEnabled = true;
						}
					}
					
				} else {
					_firstPropTween = insertPropTween(this.target, p, this.target[p], enumerables[p], p, false, _firstPropTween); 
				}
			}
			if (prioritize) {
				_firstPropTween = onPluginEvent("onInit", _firstPropTween); //reorders the linked list in order of priority. Uses a static TweenPlugin method in order to minimize file size in TweenLite
			}
			if (this.vars.runBackwards == true) {
				var pt:PropTween = _firstPropTween;
				while (pt) {
					pt.start += pt.change;
					pt.change = -pt.change;
					pt = pt.nextNode;
				}
			}
			_hasUpdate = Boolean(this.vars.onUpdate != null);
			if (_overwrittenProps != null) { //another tween may have tried to overwrite properties of this tween before init() was called (like if two tweens start at the same time, the one created second will run first)
				killVars(_overwrittenProps);
			}
			if (TweenLite.overwriteManager.enabled && _firstPropTween != null && TweenLite.overwriteManager.mode > 1 && this.target in masterList) {
				overwriteManager.manageOverwrites(this, propTweenLookup, masterList[this.target]);
			}
			this.initted = true;
		}
		
		/**
		 * @private
		 * Inserts a new property tween into the linked list.
		 * 
		 * @param $target Object whose property is being tweened
		 * @param $property Name of the property that is being tweened (according to the property tween's target)
		 * @param $start Starting value of the property
		 * @param $end End value of the property (if it is a String, it will be interpreted as relative)
		 * @param $name The name of the property that is being tweened (according to tween's target). This can be different than the "property". For example, for a bezier tween, the target could be the plugin, the property could be "changeFactor", and the name could be "x" or "_MULTIPLE_" if the plugin is managing more than one property. This aids in overwrite management.
		 * @param $isPlugin Indicates whether or not the property tween is a plugin
		 * @param $nextNode Next PropTween instance in the linked list. (this just helps speed things up)
		 * @return PropTween instance that was created/inserted
		 */
		protected function insertPropTween($target:Object, $property:String, $start:Number, $end:*, $name:String, $isPlugin:Boolean, $nextNode:PropTween):PropTween {
			var pt:PropTween = new PropTween($target, $property, $start, (typeof($end) == "number") ? $end - $start : Number($end), $name, $isPlugin, $nextNode);
			if ($nextNode != null) {
				$nextNode.prevNode = pt;
			}
			if ($isPlugin && $name == "_MULTIPLE_") {
				var op:Array = $target.overwriteProps;
				var i:int = op.length;
				while (i-- > 0) {
					propTweenLookup[op[i]] = pt;
				}
			} else {
				propTweenLookup[$name] = pt;
			}
			return pt;
		}
		
		/**
		 * Renders the tween at a particular time (or frame number for frames-based tweens). 
		 * The time is based simply on the overall duration. For example, if a tween's duration
		 * is 3, renderTime(1.5) would render it at the halfway finished point.
		 * 
		 * @param $time time (or frame number for frames-based tweens) to render.
		 * @param $suppressEvents If true, no events or callbacks will be triggered for this render (like onComplete, onUpdate, onReverseComplete, etc.)
		 * @param $force Normally the tween will skip rendering if the $time matches the cachedTotalTime (to improve performance), but if $force is true, it forces a render. This is primarily used internally for tweens with durations of zero in TimelineLite/Max instances.
		 */
		override public function renderTime($time:Number, $suppressEvents:Boolean=false, $force:Boolean=false):void {
			var factor:Number, isComplete:Boolean, prevTime:Number = this.cachedTime;
			this.active = true; //so that if the user renders a tween (as opposed to the timeline rendering it), the timeline is forced to re-render and align it with the proper time/frame on the next rendering cycle. Maybe the tween already finished but the user manually re-renders it as halfway done.
			if ($time >= this.cachedDuration) {
				this.cachedTotalTime = this.cachedTime = this.cachedDuration;
				factor = 1;
				isComplete = true;
				if (this.cachedDuration == 0) { //zero-duration tweens are tricky because we must discern the momentum/direction of time in order to determine whether the starting values should be rendered or the ending values. If the "playhead" of its timeline goes past the zero-duration tween in the forward direction or lands directly on it, the end values should be rendered, but if the timeline's "playhead" moves past it in the backward direction (from a postitive time to a negative time), the starting values must be rendered.
					if (($time == 0 || _rawPrevTime < 0) && _rawPrevTime != $time) {
						$force = true;
					}		
					_rawPrevTime = $time;
				}
				
			} else if ($time <= 0) {
				this.cachedTotalTime = this.cachedTime = factor = 0;
				if ($time < 0) {
					this.active = false;
					if (this.cachedDuration == 0) { //zero-duration tweens are tricky because we must discern the momentum/direction of time in order to determine whether the starting values should be rendered or the ending values. If the "playhead" of its timeline goes past the zero-duration tween in the forward direction or lands directly on it, the end values should be rendered, but if the timeline's "playhead" moves past it in the backward direction (from a postitive time to a negative time), the starting values must be rendered.
						if (_rawPrevTime > 0) {
							$force = true;
							isComplete = true;
						}
						_rawPrevTime = $time;
					}
				}
				
			} else {
				this.cachedTotalTime = this.cachedTime = $time;
				factor = this.ease($time, 0, 1, this.cachedDuration);
			}			
			
			if (this.cachedTime == prevTime && !$force) {
				return;
			} else if (!this.initted) {
				init();
			}
			if (prevTime == 0 && this.vars.onStart != null && !$suppressEvents) {
				this.vars.onStart.apply(null, this.vars.onStartParams);
			}
			
			var pt:PropTween = _firstPropTween;
			while (pt) {
				pt.target[pt.property] = pt.start + (factor * pt.change);
				pt = pt.nextNode;
			}
			if (_hasUpdate && !$suppressEvents) {
				this.vars.onUpdate.apply(null, this.vars.onUpdateParams);
			}
			if (isComplete) {
				complete(true, $suppressEvents);
			}
		}
		
		/**
		 * Forces the tween to completion.
		 * 
		 * @param $skipRender to skip rendering the final state of the tween, set skipRender to true. 
		 * @param $suppressEvents If true, no events or callbacks will be triggered for this render (like onComplete, onUpdate, onReverseComplete, etc.)
		 */
		override public function complete($skipRender:Boolean=false, $suppressEvents:Boolean=false):void {
			if (!$skipRender) {
				renderTime(this.cachedTotalDuration, $suppressEvents, false); //just to force the final render
				return; //renderTime() will call complete(), so just return here.
			}
			if (_hasPlugins) {
				onPluginEvent("onComplete", _firstPropTween);
			}
			if (this.timeline.autoRemoveChildren) {
				this.setEnabled(false, false);
			} else {
				this.active = false;
			}
			if (this.vars.onComplete != null && (this.cachedTotalTime != 0 || this.cachedDuration == 0) && !$suppressEvents) { //if cachedTotalTime is zero, it must be a reversed TweenMax instance.
				this.vars.onComplete.apply(null, this.vars.onCompleteParams);
			}
		}
		
		/**
		 * Allows particular properties of the tween to be killed. For example, if a tween is affecting 
		 * the "x", "y", and "alpha" properties and you want to kill just the "x" and "y" parts of the 
		 * tween, you'd do myTween.killVars({x:true, y:true});
		 * 
		 * @param $vars An object containing a corresponding property for each one that should be killed. The values don't really matter. For example, to kill the x and y property tweens, do myTween.killVars({x:true, y:true});
		 * @param $permanent If true, the properties specified in the $vars object will be permanently disallowed in the tween. Typically the only time false might be used is while the tween is in the process of initting and a plugin needs to make sure tweens of a particular property (or set of properties) is killed. 
		 */
		public function killVars($vars:Object, $permanent:Boolean=true):void {
			if (_overwrittenProps == null) {
				_overwrittenProps = {};
			}
			var p:String, pt:PropTween;
			for (p in $vars) {
				if (p in propTweenLookup) {
					pt = propTweenLookup[p];
					if (pt.isPlugin && pt.name == "_MULTIPLE_") { //plugin with multiple overwritable properties
						pt.target.killProps($vars);
						if (pt.target.overwriteProps.length == 0) {
							removePropTween(pt);
							delete propTweenLookup[p];
						}
					} else {
						removePropTween(pt);
						delete propTweenLookup[p];
					}
				}
				if ($permanent) {
					_overwrittenProps[p] = 1;
				}
			}
		}
		
		/**
		 * @private
		 * Removes a PropTween from the linked list
		 * 
		 * @param $propTween PropTween to remove
		 */
		protected function removePropTween($propTween:PropTween):void {
			if ($propTween.isPlugin && $propTween.target.onDisable != null) {
				$propTween.target.onDisable(); //some plugins need to be notified so they can perform cleanup tasks first
			}
			if ($propTween.nextNode != null) {
				$propTween.nextNode.prevNode = $propTween.prevNode;
			}
			if ($propTween.prevNode != null) {
				$propTween.prevNode.nextNode = $propTween.nextNode;
			} else if (_firstPropTween == $propTween) {
				_firstPropTween = $propTween.nextNode;
			}
		}
		
		/**
		 * @private
		 * If a tween is enabled, it is eligible to be rendered (unless it is paused). Setting enabled to
		 * false essentially removes it from its timeline and makes it eligible for garbage collection internally.
		 * 
		 * @param $b Enabled state of the tween
		 * @param $ignoreTimeline By default, the tween will remove itself from its timeline when it is disabled, and add itself when it is enabled, but this parameter allows you to override that behavior.
		 */	
		override public function setEnabled($b:Boolean, $ignoreTimeline:Boolean=false):void {
			if ($b == this.gc) {
				if ($b) {
					if (!(this.target in TweenLite.masterList)) {
						TweenLite.masterList[this.target] = [this];
					} else {
						TweenLite.masterList[this.target].push(this);
					}
				}
				super.setEnabled($b, $ignoreTimeline);
				if (_notifyPluginsOfEnabled) {
					onPluginEvent((($b) ? "onEnable" : "onDisable"), _firstPropTween);
				}
			}
		}
		
		
//---- STATIC FUNCTIONS -----------------------------------------------------------------------------------
		
		/**
		 * Static method for creating a TweenLite instance. This can be more intuitive for some developers 
		 * and shields them from potential garbage collection issues that could arise when assigning a
		 * tween instance to a variable that persists. The following lines of code produce exactly 
		 * the same result: <br /><br /><code>
		 * 
		 * var myTween:TweenLite = new TweenLite(mc, 1, {x:100}); <br />
		 * TweenLite.to(mc, 1, {x:100}); <br />
		 * var myTween:TweenLite = TweenLite.to(mc, 1, {x:100});</code>
		 * 
		 * @param $target Target object whose properties this tween affects. This can be ANY object, not just a DisplayObject. 
		 * @param $duration Duration in seconds (or in frames if the tween's timing mode is frames-based)
		 * @param $vars An object containing the end values of the properties you're tweening. For example, to tween to x=100, y=100, you could pass {x:100, y:100}. It can also contain special properties like "onComplete", "ease", "delay", etc.
		 * @return TweenLite instance
		 */
		public static function to($target:Object, $duration:Number, $vars:Object):TweenLite {
			return new TweenLite($target, $duration, $vars);
		}
		
		/**
		 * Static method for creating a TweenLite instance that tweens in the opposite direction
		 * compared to a TweenLite.to() tween. In other words, you define the START values in the 
		 * vars object instead of the end values, and the tween will use the current values as 
		 * the end values. This can be very useful for animating things into place on the stage
		 * because you can build them in their end positions and do some simple TweenLite.from()
		 * calls to animate them into place. <b>NOTE:</b> By default, <code>immediateRender</code>
		 * is <code>true</code> in from() tweens, meaning that they immediately render their starting state 
		 * regardless of any delay that is specified. You can override this behavior by passing 
		 * <code>immediateRender:false</code> in the <code>$vars</code> object so that it will wait to 
		 * render until the tween actually begins (often the desired behavior when inserting into timelines). 
		 * To illustrate the default behavior, the following code will immediately set the <code>alpha</code> of <code>mc</code> 
		 * to 0 and then wait 2 seconds before tweening the <code>alpha</code> back to 1 over the course 
		 * of 1.5 seconds:<br /><br /><code>
		 * 
		 * TweenLite.from(mc, 1.5, {alpha:0, delay:2});</code>
		 * 
		 * @param $target Target object whose properties this tween affects. This can be ANY object, not just a DisplayObject. 
		 * @param $duration Duration in seconds (or in frames if the tween's timing mode is frames-based)
		 * @param $vars An object containing the start values of the properties you're tweening. For example, to tween from x=100, y=100, you could pass {x:100, y:100}. It can also contain special properties like "onComplete", "ease", "delay", etc.
		 * @return TweenLite instance
		 */
		public static function from($target:Object, $duration:Number, $vars:Object):TweenLite {
			$vars.runBackwards = true;
			if ($vars.immediateRender != false) {
				$vars.immediateRender = true;
			}
			return new TweenLite($target, $duration, $vars);
		}
		
		/**
		 * Provides a simple way to call a function after a set amount of time (or frames). You can
		 * optionally pass any number of parameters to the function too. For example:<br /><br /><code>
		 * 
		 * TweenLite.delayedCall(1, myFunction, ["param1", 2]); <br />
		 * function myFunction($param1:String, $param2:Number):void { <br />
		 *     trace("called myFunction and passed params: " + $param1 + ", " + $param2); <br />
		 * } </code>
		 * 
		 * @param $delay Delay in seconds (or frames if useFrames is true) before the function should be called
		 * @param $onComplete Function to call
		 * @param $onCompleteParams An Array of parameters to pass the function.
		 * @param $useFrames If the delay should be measured in frames instead of seconds, set useFrames to true (default is false)
		 * @return TweenLite instance
		 */
		public static function delayedCall($delay:Number, $onComplete:Function, $onCompleteParams:Array=null, $useFrames:Boolean=false):TweenLite {
			return new TweenLite($onComplete, 0, {delay:$delay, onComplete:$onComplete, onCompleteParams:$onCompleteParams, immediateRender:false, useFrames:$useFrames, overwrite:0});
		}
		
		/**
		 * @private
		 * Updates the rootTimeline and rootFramesTimeline and collects garbage every 60 frames.
		 * 
		 * @param $e ENTER_FRAME Event
		 */
		protected static function updateAll($e:Event = null):void {
			rootTimeline.renderTime(((getTimer() * 0.001) - rootTimeline.startTime) * rootTimeline.cachedTimeScale, false, false);
			rootFrame++;
			rootFramesTimeline.renderTime((rootFrame - rootFramesTimeline.startTime) * rootFramesTimeline.cachedTimeScale, false, false);
			
			if (!(rootFrame % 60)) { //garbage collect every 60 frames...
				var ml:Dictionary = masterList, tgt:Object, a:Array, i:int;
				for (tgt in ml) {
					a = ml[tgt];
					i = a.length;
					while (i-- > 0) {
						if (a[i].gc) {
							a.splice(i, 1);
						}
					}
					if (a.length == 0) {
						delete ml[tgt];
					}
				}
			}
			
		}
		
		/**
		 * Kills all the tweens of a particular object, optionally completing them first.
		 * 
		 * @param $target Object whose tweens should be immediately killed
		 * @param $complete Indicates whether or not the tweens should be forced to completion before being killed.
		 */
		public static function killTweensOf($target:Object, $complete:Boolean=false):void {
			if ($target in masterList) {
				var a:Array = masterList[$target];
				var i:int = a.length;
				while (i-- > 0) {
					if (!a[i].gc) {
						if ($complete) {
							a[i].complete(false, false);
						} else {
							a[i].setEnabled(false, false);
						}
					}
				}
				delete masterList[$target];
			}
		}
		
		/**
		 * @private
		 * Default easing equation
		 * 
		 * @param $t time
		 * @param $b start
		 * @param $c change
		 * @param $d duration
		 * @return Eased value
		 */
		protected static function easeOut($t:Number, $b:Number, $c:Number, $d:Number):Number {
			return -$c * ($t /= $d) * ($t - 2) + $b;
		}
			
		/**
		 * @private
		 * Only used for easing equations that accept extra parameters (like Elastic.easeOut and Back.easeOut).
		 * Basically, it acts as a proxy. To utilize it, pass an Array of extra parameters via the vars object's
		 * "easeParams" special property
		 *  
		 * @param $t time
		 * @param $b start
		 * @param $c change
		 * @param $d duration
		 * @return Eased value
		 */
		protected function easeProxy($t:Number, $b:Number, $c:Number, $d:Number):Number { 
			return this.vars.proxiedEase.apply(null, arguments.concat(this.vars.easeParams));
		}
		
	}
	
}