package {
	import flash.net.URLLoader;
	import flash.events.Event;
	import flash.net.URLRequest;
	import flash.display.MovieClip;
	import flash.events.MouseEvent;
	import flash.net.navigateToURL;
	import flash.events.ProgressEvent;
	import flash.text.TextField;

	public class P_Click extends MovieClip {

		public function P_Click(){
			trace("OK");
			//this.loaderInfo.addEventListener(ProgressEvent.PROGRESS, NONO);
			//this.loaderInfo.addEventListener(Event.COMPLETE, OKOK);
			for (var i:int = 0; i < 7; i++){
				this["btn" + i + "_mc"].addEventListener(MouseEvent.CLICK, onClick);
				this["btn" + i + "_mc"].addEventListener(MouseEvent.ROLL_OVER, onOver);
				this["btn" + i + "_mc"].addEventListener(MouseEvent.ROLL_OUT, onOut);
				this["btn" + i + "_mc"].buttonMode = true;
			}
		}
		private function onOut(e:MouseEvent):void {
			if (e.currentTarget == btn0_mc){
			    btn00_mc.gotoAndPlay(13);
			}	
			if (e.currentTarget == btn1_mc){
			    btn11_mc.gotoAndPlay(13);
			}
			if (e.currentTarget == btn2_mc){
			    btn22_mc.gotoAndPlay(13);
			}
			if (e.currentTarget == btn3_mc){
			    btn33_mc.gotoAndPlay(13);
			}
			if (e.currentTarget == btn4_mc){
			    btn44_mc.gotoAndPlay(13);
			}
			if (e.currentTarget == btn5_mc){
			    btn55_mc.gotoAndPlay(13);
			}
			if (e.currentTarget == btn6_mc){
			    btn66_mc.gotoAndPlay(13);
			}
		}

		private function onOver(e:MouseEvent):void {
			if (e.currentTarget == btn0_mc){
			    btn00_mc.gotoAndPlay(2);
			}
			if (e.currentTarget == btn1_mc){
			    btn11_mc.gotoAndPlay(2);
			}
			if (e.currentTarget == btn2_mc){
			    btn22_mc.gotoAndPlay(2);
			}
			if (e.currentTarget == btn3_mc){
			    btn33_mc.gotoAndPlay(2);
			}
			if (e.currentTarget == btn4_mc){
			    btn44_mc.gotoAndPlay(2);
			}
			if (e.currentTarget == btn5_mc){
			    btn55_mc.gotoAndPlay(2);
			}
			if (e.currentTarget == btn6_mc){
			    btn66_mc.gotoAndPlay(2);
			}
		}
		/*private function OKOK(E:Event){
			gotoAndPlay(5);
			//SHOW_txt.visible = false;
			loading_mc.visible = false;
		}

		private function NONO(E:ProgressEvent){
			var DD:uint = E.bytesLoaded;
			var TT:uint = E.bytesTotal;
			var PP:uint = Math.ceil((DD / TT) * 100);
			gotoAndStop(1);
			//SHOW_txt.text = String(PP + "%");

			//bar_mv.gotoAndStop(PP);
		}*/

		private function onClick(e:MouseEvent):void {
			if (e.currentTarget == btn0_mc){
				var AA:URLRequest = new URLRequest("index.php?cmsid=2");
				navigateToURL(AA, "_self");
			}
			if (e.currentTarget == btn1_mc){
				var BB:URLRequest = new URLRequest("index.php?cmsid=3");
				navigateToURL(BB, "_self");
			}
			if (e.currentTarget == btn2_mc){
				var CC:URLRequest = new URLRequest("index.php?cmsid=4");
				navigateToURL(CC, "_self");
			}
			if (e.currentTarget == btn3_mc){
				var DD:URLRequest = new URLRequest("index.php?cmsid=5");
				navigateToURL(DD, "_self");
			}
			if (e.currentTarget == btn4_mc){
				var EE:URLRequest = new URLRequest("index.php?cmsid=6");
				navigateToURL(EE, "_self");
			}
			if (e.currentTarget == btn5_mc){
				var FF:URLRequest = new URLRequest("index.php?cmsid=7");
				navigateToURL(FF, "_self");
			}
			if (e.currentTarget == btn6_mc){
				var GG:URLRequest = new URLRequest("index.php?cmsid=8");
				navigateToURL(GG, "_self");
			}

		}

	}
}