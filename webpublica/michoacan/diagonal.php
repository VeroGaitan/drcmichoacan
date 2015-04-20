<HTML>
<HEAD>
<STYLE>
.positioned { position: relative; }
</STYLE>
<SCRIPT>
var id = 0;
function muestra_en_diagonal (text, down, deg, lsp) {
  deg = deg || 45;
  deg = Math.PI / 180 * deg;
  lsp = lsp || 10;
  dy = lsp * Math.tan(deg);
  var html = '';
  html += '<DIV style="font-size:50;color:gray;" ID="td' + id + '"' + ' CLASS="positioned"' + '>';
  if (down) {
    for (var r = 0; r < text.length; r++) {
      html += '<SPAN ID="td' + id + r
             + '" CLASS="positioned" STYLE="left: '
             + (r * lsp) + 'px; top: ' + (r * dy) + 'px;">';
      html += text.charAt(r);
      html += '</SPAN>';
    }
  }
  else {
    for (var r = 0; r < text.length; r++) {
      html += '<SPAN ID="td' + id + r
              + '" CLASS="positioned" STYLE="left: '
              + (r * lsp) + 'px; top: '
              + ((text.length - r) * dy) + 'px;">';
      html += text.charAt(r);
      html += '</SPAN>';
    }
  }
  html += '</DIV>';
  id++;
  document.write(html);
}
</SCRIPT>
</HEAD>
<BODY>
<SCRIPT>
muestra_en_diagonal('DOCUMENTO SIN VALOR', true,260, 2,100);
</SCRIPT>
</BODY>
</HTML