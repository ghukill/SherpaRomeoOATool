# Script to generate reports for an author
# expects sys.argv'ss 1-> author_id, 2-> author_name

import os
import sys
from string import Template

author_id = sys.argv[1]
author_name = sys.argv[2]
author_name = author_name.replace(" ", "_") #replaces whitespace

os.system( Template('/usr/local/bin/wkhtmltopdf http://141.217.54.38/~ej2929/sherpa_tool/report_output.php?author_id=$author_id ./pdfs/$author_name.pdf').substitute(author_id=author_id, author_name=author_name) )

#testing
goober = Template('/usr/local/bin/wkhtmltopdf http://141.217.54.38/~ej2929/sherpa_tool/report_output.php?author_id=$author_id ./pdfs/$author_name.pdf').substitute(author_id=author_id, author_name=author_name)
print goober