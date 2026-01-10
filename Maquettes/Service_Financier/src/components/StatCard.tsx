import { LucideIcon } from 'lucide-react';

interface StatCardProps {
  title: string;
  value: string;
  icon: LucideIcon;
  iconBgColor: string;
  iconColor: string;
  count?: number;
}

export function StatCard({ title, value, icon: Icon, iconBgColor, iconColor, count }: StatCardProps) {
  return (
    <div className="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
      <div className="flex items-start justify-between mb-4">
        <p className="text-gray-600">{title}</p>
        <div className={`${iconBgColor} p-2 rounded`}>
          <Icon className={iconColor} size={24} />
        </div>
      </div>
      <p className="text-[#00205B] mb-1">{value}</p>
      {count !== undefined && (
        <p className="text-gray-500">{count} transaction{count > 1 ? 's' : ''}</p>
      )}
    </div>
  );
}
