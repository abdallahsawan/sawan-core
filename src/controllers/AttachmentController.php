<?php

namespace Sawan\Core\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Sawan\Core\Models\Attachment;
use Validator;
use Response;

class AttachmentController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'file|required',
            'tag' => 'required'
        ]);
        if ($validator->fails()) {
            return "Bad request";
        }
        $file = $request->file('file');
        $fullFileName = $file->getClientOriginalName();
        $fileName = pathinfo($fullFileName, PATHINFO_FILENAME);
        $fileExtension = pathinfo($fullFileName, PATHINFO_EXTENSION);
        if ($fileExtension == null) {
            return "Not Allowed file type (Extension doesn't exist)";
        } else if (in_array(strtoupper($fileExtension), $this->NOT_ALLOWED_EXTENSIONS)) {
            return "Not Allowed file type (" . strtoupper($fileExtension) . ")";
        }
        $path = $fileName . "_" . Carbon::now()->timestamp . "." . $fileExtension;
        $path = $file->storeAs('attachments', $path, ['disk' => 'public']);
        if (Storage::disk('public')->exists($path)) {
            $attachment = new Attachment();
            $attachment->name = $fileName;
            $attachment->extension = $fileExtension;
            $attachment->mime_type = $file->getClientMimeType();
            $attachment->size = $file->getSize();
            $attachment->path = $path;
            $attachment->tag = $request->tag;
            $attachment->save();
            return $attachment;
        } else {
            return "Unknown error while saving file";
        }
    }

    public function download($id) {
        $attachment = Attachment::find($id);
        $headers = array(
            'Content-Type: ' . $attachment->mime_type,
        );
        return Response::download(Storage::disk('public')->path($attachment->path) , $attachment->name . '.' . $attachment->extension , $headers);

    }

    private $NOT_ALLOWED_EXTENSIONS = array(
        "0XE",
        "73K",
        "89K",
        "8CK",
        "A6P",
        "A7R",
        "AC",
        "ACC",
        "ACR",
        "ACTC",
        "ACTION",
        "ACTM",
        "AHK",
        "AIR",
        "APK",
        "APP",
        "APPLESCRIPT",
        "ARSCRIPT",
        "ASB",
        "AZW2",
        "BA_",
        "BAT",
        "BEAM",
        "BIN",
        "BTM",
        "CACTION",
        "CEL",
        "CELX",
        "CGI",
        "CMD",
        "COF",
        "COFFEE",
        "COM",
        "COMMAND",
        "CSH",
        "CYW",
        "DEK",
        "DLD",
        "DMC",
        "DS",
        "DXL",
        "E_E",
        "EAR",
        "EBM",
        "EBS",
        "EBS2",
        "ECF",
        "EHAM",
        "ELF",
        "EPK",
        "ES",
        "ESH",
        "EX4",
        "EX5",
        "EX_",
        "EXE",
        "EXE1",
        "EXOPC",
        "EZS",
        "EZT",
        "FAS",
        "FKY",
        "FPI",
        "FRS",
        "FXP",
        "GADGET",
        "GPE",
        "GPU",
        "GS",
        "HAM",
        "HMS",
        "HPF",
        "HTA",
        "ICD",
        "IIM",
        "IPA",
        "IPF",
        "ISU",
        "ITA",
        "JAR",
        "JS",
        "JSE",
        "JSX",
        "KIX",
        "KSH",
        "KX",
        "LO",
        "LS",
        "M3G",
        "MAM",
        "MCR",
        "MEL",
        "MEM",
        "MIO",
        "MLX",
        "MM",
        "MPX",
        "MRC",
        "MRP",
        "MS",
        "MSL",
        "MXE",
        "N",
        "NEXE",
        "ORE",
        "OSX",
        "OTM",
        "OUT",
        "PAF",
        "PAF.EXE",
        "PEX",
        "PHAR",
        "PIF",
        "PLSC",
        "PLX",
        "PRC",
        "PRG",
        "PS1",
        "PVD",
        "PWC",
        "PYC",
        "PYO",
        "QIT",
        "QPX",
        "RBX",
        "RFU",
        "RGS",
        "ROX",
        "RPJ",
        "RUN",
        "RXE",
        "S2A",
        "SBS",
        "SCA",
        "SCAR",
        "SCB",
        "SCPT",
        "SCPTD",
        "SCR",
        "SCRIPT",
        "SCT",
        "SEED",
        "SHB",
        "SMM",
        "SPR",
        "TCP",
        "THM",
        "TMS",
        "U3P",
        "UDF",
        "UPX",
        "VBE",
        "VBS",
        "VBSCRIPT",
        "VDO",
        "VEXE",
        "VLX",
        "VPM",
        "VXP",
        "WCM",
        "WIDGET",
        "WIZ",
        "WORKFLOW",
        "WPK",
        "WPM",
        "WS",
        "WSF",
        "WSH",
        "X86",
        "XAP",
        "XBAP",
        "XLM",
        "XQT",
        "XYS",
        "ZL9");
}
