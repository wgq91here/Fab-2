/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var xheditor = Array();
var currentEditorID = null;


function simpletext_onshow(fieldID) {
 // alert(fieldID);
  SimpleText_changeID(fieldID);
  SimpleText_shower(fieldID);
}

function SimpleText_shower(fieldID) {
  if ( currentEditorID == null )
  {
	currentEditorID = fieldID;
  }

    xheditor[currentEditorID] = $('#fieldLabel_'+ currentEditorID).xheditor({
       plugins:{
        update:{c:'xheIcon xheBtnSelectAll',t:'修改内容(Ctrl+Enter)',s:'ctrl+enter',e:function(){
          var _this=this;
          changeLabel(currentEditorID, _this.getSource());
          }},
          hr:{c:'xheIcon xheBtnRemoveformat',t:'划线',s:'ctrl+h',e:function(){
            var _this=this;
            _this.focus();
            _this.pasteHTML('<hr/>');
          }}
        },
      tools:'update,Cut,Copy,Paste,Pastetext,Separator,Source,About'
    });
    //alert(editor.getSource());

  }

/*
function SimpleText_shower(fieldID) {
  if ( currentEditorID == null )
  {
	currentEditorID = fieldID;
  }

    xheditor[currentEditorID] = $('#fieldLabel_'+ currentEditorID).xheditor({
      plugins:{
        update:{c:'xheIcon xheBtnPreview',t:'修改内容(Ctrl+Enter)',s:'ctrl+enter',e:function(){
          var _this=this;
          changeLabel(currentEditorID, _this.getSource());
        }},
        hr:{c:'xheIcon xheBtnRemoveformat',t:'划线',s:'ctrl+h',e:function(){
          var _this=this;
          _this.focus();
          _this.pasteHTML('<hr/>');
        }}
      },
      width:'100%',
      tools:'update,Separator,Cut,Copy,Paste,Pastetext,Bold,FontColor,hr,Separator,GEnd'
    });
    //alert(editor.getSource());

  }
*/
  function SimpleText_changeID(fieldID) {
	  currentEditorID = fieldID;
  }
