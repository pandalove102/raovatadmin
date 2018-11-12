<?php 
class form
{
	function __construct()
	{
		
	}
	function input($data=array())
	{
		$control = '';
		switch($data['type'])
		{
			case 'text':
				$control = '<div class="form-group">
						<label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Text').'</label>
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
						<input type="text" id="'.(isset($data['id'])?$data['id']:'text').'" '.(isset($data['required'])?'required':'').' style="'.(isset($data['style'])?$data['style']:'').'"  name="'.(isset($data['name'])?$data['name']:'text').'" class="'.(isset($data['class'])?$data['class']:'form-control').'" value="'.(isset($data['isvalue'])?$data['isvalue']:'').'"/></div>						
					</div>';
				break;
			case 'number':				
				$control = '<div class="form-group">
						<label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Number').'</label>
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
						<input type="number" id="'.(isset($data['id'])?$data['id']:'number').'" '.(isset($data['required'])?'required':'').' style="'.(isset($data['style'])?$data['style']:'').'"  name="'.(isset($data['name'])?$data['name']:'number').'" class="'.(isset($data['class'])?$data['class']:'form-control').'" value="'.(isset($data['isvalue'])?$data['isvalue']:'').'"/></div>						
					</div>';
				break;
			case 'date':
				$control = '<div class="form-group">
						<label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Date').'</label>
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
						<input type="text" id="'.(isset($data['id'])?$data['id']:'date').'" '.(isset($data['required'])?'required':'').' style="'.(isset($data['style'])?$data['style']:'').'"  name="'.(isset($data['name'])?$data['name']:'date').'" class="'.(isset($data['class'])?$data['class']:'').' form-control date" value="'.(isset($data['isvalue'])?$data['isvalue']:'').'"/></div>						
					</div>';
				break;
			case 'email':
				$control = '<div class="form-group">
						<label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Email').'</label>
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
						<input type="email" id="'.(isset($data['id'])?$data['id']:'email').'" '.(isset($data['required'])?'required':'').' style="'.(isset($data['style'])?$data['style']:'').'"  name="'.(isset($data['name'])?$data['name']:'email').'" class="'.(isset($data['class'])?$data['class']:'form-control').'" value="'.(isset($data['isvalue'])?$data['isvalue']:'').'"/></div>						
					</div>';
				break;
			case 'radio':
				if(isset($data['data']) && $data['data']){					
					$control = '<div class="form-group"><label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Email').'</label>						
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">';
					foreach($data['data'] as $value){
					$control .='<label class="checkbox-inline i-checks"> 
								<input type="radio" '.(isset($data['isvalue']) && $data['isvalue']==$value['value']?'checked':'').' value="'.$value['value'].'" name="'.(isset($data['name'])?$data['name']:'radio').'"> '.$value['label'].'</label>';
					}		
					$control .=	'</div>						
					</div>';
				}
				break;
			case 'checkbox':
				if(isset($data['data']) && $data['data']){					
					$control = '<div class="form-group"><label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Email').'</label>						
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">';
					foreach($data['data'] as $value){
					$control .='<label class="checkbox-inline i-checks"> 
								<input type="checkbox" '.(isset($data['isvalue']) && ($data['isvalue']==$value['value']|| (is_array($data['isvalue']) && in_array($value['value'],$data['isvalue'])))?'checked':'').' value="'.$value['value'].'" name="'.(isset($data['name'])?$data['name']:'checkbox').'"> '.$value['label'].'</label>';
					}		
					$control .=	'</div>						
					</div>';
				}
				break;
			case 'dropdown':
				if(isset($data['data']) && $data['data']){					
					$control = '<div class="form-group"><label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Email').'</label>						
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
						<select id="'.(isset($data['id'])?$data['id']:'dropdown').'" '.(isset($data['required'])?'required':'').' style="'.(isset($data['style'])?$data['style']:'').'"  name="'.(isset($data['name'])?$data['name']:'dropdown').'" class="'.(isset($data['class'])?$data['class']:'form-control').'" size="'.(isset($data['size'])?$data['size']:'').'" '.(isset($data['multiple'])?'multiple':'').' >
						';
					foreach($data['data'] as $value){
					$control .='<option '.(isset($data['isvalue']) && ($data['isvalue']==$value['value'] || (is_array($data['isvalue']) && in_array($value['value'],$data['isvalue'])))?'selected':'').' value="'.$value['value'].'" >'.$value['label'].'</option>';
					}		
					$control .=	'</select>						
					</div></div>';
				}
				break;
			case 'linkbutton':
				$control = '<a href="'.(isset($data['href'])?$data['href']:'#').'" id="'.(isset($data['id'])?$data['id']:'button').'" '.(isset($data['required'])?'required':'').' style="'.(isset($data['style'])?$data['style']:'').'"  name="'.(isset($data['name'])?$data['name']:'button').'" class="'.(isset($data['class'])?$data['class']:'btn btn-sm btn-success').'" data-value="'.(isset($data['isvalue'])?$data['isvalue']:'').'">'.(isset($data['label'])?$data['label']:'Link Button').'</a>';
				break;
			case 'button':
				$control = '<button id="'.(isset($data['id'])?$data['id']:'button').'" '.(isset($data['required'])?'required':'').' style="'.(isset($data['style'])?$data['style']:'').'"  name="'.(isset($data['name'])?$data['name']:'button').'" class="'.(isset($data['class'])?$data['class']:'btn btn-sm btn-success').'" value="'.(isset($data['isvalue'])?$data['isvalue']:'').'">'.(isset($data['label'])?$data['label']:'Button').'</button>';
				break;
			case 'color':
				$control = '<div class="form-group">
						<label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Textarea').'</label>
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
						<input type="color" id="'.(isset($data['id'])?$data['id']:'color').'" '.(isset($data['required'])?'required':'').' style="'.(isset($data['style'])?$data['style']:'').'"  name="'.(isset($data['name'])?$data['name']:'color').'" class="'.(isset($data['class'])?$data['class']:'form-control').'" value="'.(isset($data['isvalue'])?$data['isvalue']:'').'"/></div>						
					</div>';
				break;
			case 'image':
				$control ='<div class="form-group">
						<label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Image').'</label>
                        <div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
                           <img src="'.(isset($data['isvalue'])?$data['isvalue']:'layout/images/no-image.png').'" height="100px" width="100px">
                           <input '.(isset($data['required'])?'required':'').' type="hidden" name="'.(isset($data['name'])?$data['name']:'image').'" value="'.(isset($data['isvalue'])?$data['isvalue']:'').'"  id="'.(isset($data['id'])?$data['id']:'image').'" />
                            <button class="btn btn-info" type="button" onclick="openPopup(\''.(isset($data['id'])?$data['id']:'image').'\')">Change</button>
                           '.(isset($data['note'])?$data['note']:'').'</div>';
				break;
			case 'images':
				break;
			case 'editor':
				$control = '<div class="form-group">
						<label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Editor').'</label>
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
						<textarea '.(isset($data['required'])?'required':'').' id="'.(isset($data['id'])?$data['id']:'editor').'"  rows="'.(isset($data['rows'])?$data['rows']:'3').'"  name="'.(isset($data['name'])?$data['name']:'textarea').'" class="'.(isset($data['class'])?$data['class']:'form-control').'">'.(isset($data['isvalue'])?$data['isvalue']:'').'</textarea></div>						
					</div><script type="text/javascript">CKEDITOR.replace("'.(isset($data['id'])?$data['id']:'editor').'");</script>';
				break;
			case 'textarea':
				$control = '<div class="form-group">
						<label class="'.(isset($data['lcol'])?$data['lcol']:'col-sm-2').' control-label">'.(isset($data['label'])?$data['label']:'Textarea').'</label>
						<div class="'.(isset($data['icol'])?$data['icol']:'col-sm-10').'">
						<textarea style="'.(isset($data['style'])?$data['style']:'').'" id="'.(isset($data['id'])?$data['id']:'textarea').'" '.(isset($data['required'])?'required':'').' rows="'.(isset($data['rows'])?$data['rows']:'3').'"  name="'.(isset($data['name'])?$data['name']:'textarea').'" class="'.(isset($data['class'])?$data['class']:'form-control').'">'.(isset($data['isvalue'])?$data['isvalue']:'').'</textarea></div>						
					</div>';
				break;
		}
		return $control;
	}
}

// $f = new form();
// //textarea
// echo $f->input(array(
// 	'type'=>'textarea',
// 	'name'=>'noidung',
// 	'id'=>'noidung',
// 	'isvalue'=>'abc',
// 	'required'=>true,
// 	'label'=>'Nội dung',
// 	'rows'=>20
// ));
// //radio
// echo $f->input(array(
// 	'type'=>'radio',
// 	'name'=>'gioitinh',
// 	'isvalue'=>'nu',
// 	'label'=>'Giới tính',
// 	'data'=>array(
// 		['value'=>'nam','label'=>'nam'],
// 		['value'=>'nu','label'=>'Nữ']
// 	)
// ));
// //checkbox
// echo $f->input(array(
// 	'type'=>'checkbox',
// 	'name'=>'luachon',
// 	'id'=>'luachon',
// 	'isvalue'=>array('chon1','chon3','chon5'),
// 	'label'=>'Lựa chọn',
// 	'data'=>array(
// 		['value'=>'chon1','label'=>'Chọn 1'],
// 		['value'=>'chon2','label'=>'Chọn 2'],
// 		['value'=>'chon3','label'=>'Chọn 3'],
// 		['value'=>'chon4','label'=>'Chọn 4'],
// 		['value'=>'chon5','label'=>'Chọn 5']
// 	)
// ));
// //dropdown (select)
// //multiple => true:  chọn nhiều
// echo $f->input(array(
// 	'type'=>'dropdown',
// 	'id'=>'thanhpho',
// 	'name'=>'thanhpho',
// 	'isvalue'=>'hcm',
// 	'label'=>'Thành phố 1',
// 	'data'=>array(
// 		['value'=>'hn','label'=>'Hà nội'],
// 		['value'=>'hcm','label'=>'Hồ chí minh'],
// 		['value'=>'hue','label'=>'Huế'],
// 		['value'=>'dn','label'=>'Đà nẵng'],
// 		['value'=>'ct','label'=>'Cần thơ'],
// 	)
// ));
// echo $f->input(array(
// 	'type'=>'dropdown',
// 	'name'=>'thanhpho2',
// 	'id'=>'thanhpho2',
// 	'multiple'=>true,
// 	'isvalue'=>array('hue','hn','dn'),
// 	'label'=>'Thành phố 2',
// 	'data'=>array(
// 		['value'=>'hn','label'=>'Hà nội'],
// 		['value'=>'hcm','label'=>'Hồ chí minh'],
// 		['value'=>'hue','label'=>'Huế'],
// 		['value'=>'dn','label'=>'Đà nẵng'],
// 		['value'=>'ct','label'=>'Cần thơ'],
// 	)
// ));
// //
// echo $f->input(array(
// 	'type'=>'text',
// 	'name'=>'hoten',
// 	'isvalue'=>'Nguyễn văn anh',
// 	'label'=>'Họ tên'
// ));
?>