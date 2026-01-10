import { FileText, Plus, Download, Eye } from 'lucide-react';

export function Invoices() {
  const invoices = [
    { id: 'FACT-2024-0456', date: '28 Nov 2024', client: 'Département Informatique', montant: '450 €', statut: 'Payée', echeance: '28 Nov 2024' },
    { id: 'FACT-2024-0455', date: '27 Nov 2024', client: 'Service RH', montant: '280 €', statut: 'En attente', echeance: '04 Déc 2024' },
    { id: 'FACT-2024-0454', date: '26 Nov 2024', client: 'Laboratoire Recherche', montant: '890 €', statut: 'Payée', echeance: '26 Nov 2024' },
    { id: 'FACT-2024-0452', date: '24 Nov 2024', client: 'Service Communication', montant: '340 €', statut: 'Payée', echeance: '24 Nov 2024' },
    { id: 'FACT-2024-0451', date: '23 Nov 2024', client: 'Direction Générale', montant: '1 250 €', statut: 'En attente', echeance: '30 Nov 2024' },
  ];

  const getStatusColor = (statut: string) => {
    switch (statut) {
      case 'Payée':
        return 'bg-green-100 text-green-700';
      case 'En attente':
        return 'bg-yellow-100 text-yellow-700';
      case 'En retard':
        return 'bg-red-100 text-red-700';
      default:
        return 'bg-gray-100 text-gray-700';
    }
  };

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-[#00205B] mb-2">Gestion des Factures</h1>
          <p className="text-gray-600">Créez et gérez vos factures de colis</p>
        </div>
        <button className="flex items-center gap-2 px-6 py-3 bg-[#f5b342] text-[#00205B] rounded hover:bg-[#f5c663] transition-colors">
          <Plus size={20} />
          Nouvelle facture
        </button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex items-center justify-between mb-2">
            <p className="text-gray-600">Factures émises</p>
            <FileText className="text-blue-600" size={24} />
          </div>
          <p className="text-[#00205B]">264</p>
        </div>
        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex items-center justify-between mb-2">
            <p className="text-gray-600">Factures payées</p>
            <FileText className="text-green-600" size={24} />
          </div>
          <p className="text-[#00205B]">245</p>
        </div>
        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex items-center justify-between mb-2">
            <p className="text-gray-600">En attente</p>
            <FileText className="text-yellow-600" size={24} />
          </div>
          <p className="text-[#00205B]">12</p>
        </div>
        <div className="bg-white rounded-lg shadow-md p-6">
          <div className="flex items-center justify-between mb-2">
            <p className="text-gray-600">En retard</p>
            <FileText className="text-red-600" size={24} />
          </div>
          <p className="text-[#00205B]">7</p>
        </div>
      </div>

      <div className="bg-white rounded-lg shadow-md p-6">
        <h2 className="text-[#00205B] mb-6">Liste des factures</h2>
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="border-b border-gray-200">
                <th className="text-left pb-3 text-gray-600">Numéro</th>
                <th className="text-left pb-3 text-gray-600">Date émission</th>
                <th className="text-left pb-3 text-gray-600">Client</th>
                <th className="text-left pb-3 text-gray-600">Échéance</th>
                <th className="text-right pb-3 text-gray-600">Montant</th>
                <th className="text-center pb-3 text-gray-600">Statut</th>
                <th className="text-center pb-3 text-gray-600">Actions</th>
              </tr>
            </thead>
            <tbody>
              {invoices.map((invoice) => (
                <tr key={invoice.id} className="border-b border-gray-100 hover:bg-gray-50">
                  <td className="py-4 text-[#00205B]">{invoice.id}</td>
                  <td className="py-4 text-gray-600">{invoice.date}</td>
                  <td className="py-4 text-gray-800">{invoice.client}</td>
                  <td className="py-4 text-gray-600">{invoice.echeance}</td>
                  <td className="py-4 text-right text-[#00205B]">{invoice.montant}</td>
                  <td className="py-4">
                    <div className="flex justify-center">
                      <span className={`px-3 py-1 rounded-full text-sm ${getStatusColor(invoice.statut)}`}>
                        {invoice.statut}
                      </span>
                    </div>
                  </td>
                  <td className="py-4">
                    <div className="flex items-center justify-center gap-2">
                      <button className="p-2 text-gray-600 hover:text-[#00205B] hover:bg-gray-100 rounded transition-colors">
                        <Eye size={18} />
                      </button>
                      <button className="p-2 text-gray-600 hover:text-[#00205B] hover:bg-gray-100 rounded transition-colors">
                        <Download size={18} />
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}
