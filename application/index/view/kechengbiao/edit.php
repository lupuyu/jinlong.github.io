<form action={:url('update')} method=post><select name=status>
    <option value=1>正常<option value=2 {eq name=kechengbiao->getData('status') value=2} selected=selected{/eq}><option value=1>正常<option value=1>正常<option value=1>正常